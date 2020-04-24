/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue' 
import VueQrcodeReader from 'vue-qrcode-reader'
import VueQrCodeReaderPauseValidateComponent from './components/vue-qrcode-reader-pause-validate.vue'
import StampEmployeeComponent from './components/StampEmployeeComponent.vue'
import JobTableComponent from './components/JobTableComponent.vue'
import EmployeeTableComponent from './components/EmployeeTableComponent.vue'
import QRScannerComponentFallback from './components/QRScannerComponentFallback.vue'
import TimesheetComponent from './components/TimesheetComponent.vue'
import ReportTableComponent from './components/ReportTableComponent.vue'

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

Vue.component('vue-qr-code-reader-pv', VueQrCodeReaderPauseValidateComponent);
Vue.component('qr-scanner-component-fallback', QRScannerComponentFallback);
Vue.component('stamp-employee-component', StampEmployeeComponent);

Vue.component('employee-table-component', EmployeeTableComponent);
Vue.component('job-table-component', JobTableComponent);
Vue.component('report-table-component', ReportTableComponent);
Vue.component('timesheet-table-component', TimesheetComponent);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});