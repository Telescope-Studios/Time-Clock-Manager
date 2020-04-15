/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue' 
import VueQrcodeReader from 'vue-qrcode-reader'
import VueQrCodeReaderComponent from './components/vue-qrcode-reader.vue'
import VueQrCodeReaderPauseValidateComponent from './components/vue-qrcode-reader-pause-validate.vue'
import StampComponent from './components/StampComponent.vue'
import StampEmployeeComponent from './components/StampEmployeeComponent.vue'

Vue.use(VueQrcodeReader);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('vue-qr-code-reader', VueQrCodeReaderComponent);
Vue.component('vue-qr-code-reader-pv', VueQrCodeReaderPauseValidateComponent);
Vue.component('stamp-component', StampComponent);
Vue.component('stamp-employee-component', StampEmployeeComponent);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
