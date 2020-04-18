<template>
    <div class="modal fade" id="stampEmployee" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Stamp Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container mx-auto text-center">
                        <form @submit.prevent="stampTime">
                            <div class="form-group">
                                <div class="card text-center mx-auto">
                                    <img style="height: 200px; width: 200px; background-color: #EFEFEF; margin: 20px;" v-bind:src="'/images/' + employee.avatar" class="card-img-top rounded-circle mx-auto d-block" alt="">
                                    <div class="card-body">
                                        <h4 class="card-title">{{employee.firstname}} {{employee.lastname}}</h4>
                                        <h5 class="card-text">{{employee.job.name}}</h5>
                                        <h6 class="card-text">{{employee.slug}}</h6>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Stamp</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import EventBus from '../eventbus'

    export default{
      data(){
        return{
          employee: null
        }
      },
      created(){
        EventBus.$on('employee-stamp', data=>{
          this.employee = data;
        })
      },
      methods: {
        stampTime: function(){
          axios.post('/stamp', {
            slug: this.employee.slug,
            scan: false
          })
          .then(function(res){
            $('#stampEmployee').modal('hide')
          })
          .catch(function(err){
            console.log(err)
          });
        }
      }
    }
</script>