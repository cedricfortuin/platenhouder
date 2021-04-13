require('./bootstrap');

require('bootstrap-table');
import 'bootstrap-table/dist/bootstrap-table.css';

import Vue from 'vue';
import App from './vue/app';

const app = new Vue({
    el: '#app',
    components: { App }
});
