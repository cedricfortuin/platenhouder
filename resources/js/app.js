require('./bootstrap');

require('bootstrap-table');
import 'bootstrap-table/dist/bootstrap-table.css';

import Vue from 'vue';
import MusicApp from './vue/music/app';
import CalendarAppMonth from './vue/calendar/calendar-month';
import CalendarAppDay from './vue/calendar/calendar-day';
import MeasurementsApp from './vue/measurements/app';

new Vue({
    el: '#app',
    components: { MusicApp, CalendarAppMonth, CalendarAppDay, MeasurementsApp }
});
