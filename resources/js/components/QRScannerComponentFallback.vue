<template>
  <div>
    <qrcode-drop-zone @decode="onDecode" @init="logErrors">
      <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit">
        <div v-if="validationSuccess" class="validation-success">
          Valid Employee
        </div>

        <div v-if="validationFailure" class="validation-failure">
          Invalid Employee
        </div>

        <div v-if="validationPending" class="validation-pending">
          Validation in progress...
        </div>
      </qrcode-stream>
    </qrcode-drop-zone>
    <qrcode-capture v-if="noStreamApiSupport" @decode="onDecode" />
  </div>
</template>

<script>
import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue-qrcode-reader'
import EventBus from '../eventbus'

export default {

  components: { QrcodeStream, QrcodeDropZone, QrcodeCapture },

  data () {
    return {
      isValid: undefined,
      camera: 'auto',
      result: null,
      employee: [],
      noStreamApiSupport: false
    }
  },

  computed: {
    validationPending () {
      return this.isValid === undefined
        && this.camera === 'off'
    },

    validationSuccess () {
      return this.isValid === true
    },

    validationFailure () {
      return this.isValid === false
    }
  },

  methods: {
    onInit (promise) {
      promise
        .catch((error) =>{
          console.log(error);
          if (error.name === 'StreamApiNotSupportedError') {
            this.noStreamApiSupport = true
          }
        })
        .then(this.resetValidationState)
    },

    logErrors (promise) {
      promise.catch(console.error)
    },

    resetValidationState () {
      this.isValid = undefined
    },

    async onDecode (content) {
      this.result = content
      this.turnCameraOff()

      // pretend it's taking really long

      axios.post('/stamp',
        {
          slug: this.result,
          scan: true
        }).then((res) => {
          this.employee = res.data.employee
          EventBus.$emit('employee-stamp', res.data.employee)
          this.isValid = true
          $('#stampEmployee').modal('show')
        }).catch((error) => {
          console.log(error)
          this.isValid = false
        })

      // some more delay, so users have time to read the message
      await this.timeout(2000)

      this.turnCameraOn()
    },

    turnCameraOn () {
      this.camera = 'auto'
    },

    turnCameraOff () {
      this.camera = 'off'
    },

    timeout (ms) {
      return new Promise(resolve => {
        window.setTimeout(resolve, ms)
      })
    }
  }
}
</script>

<style scoped>
.validation-success,
.validation-failure,
.validation-pending {
  position: absolute;
  width: 100%;
  height: 100%;

  background-color: rgba(255, 255, 255, .8);
  text-align: center;
  font-weight: bold;
  font-size: 1.4rem;
  padding: 10px;

  display: flex;
  flex-flow: column nowrap;
  justify-content: center;
}
.validation-success {
  color: green;
}
.validation-failure {
  color: red;
}
</style>\