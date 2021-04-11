require('./bootstrap');

import 'chart.js'

import Vue from 'vue';
import App from './vue/app';

const app = new Vue({
    el: '#app',
    components: { App }
});
