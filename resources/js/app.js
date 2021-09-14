require('./bootstrap');

require('bootstrap-table');
import 'bootstrap-table/dist/bootstrap-table.css';

import Vue from 'vue';
import MusicApp from './vue/music/app.vue';
import CalendarAppMonth from './vue/calendar/calendar-month.vue';
import CalendarAppDay from './vue/calendar/calendar-day.vue';
import MeasurementsApp from './vue/measurements/app.vue';

new Vue({
    el: '#app',
    components: { MusicApp, CalendarAppMonth, CalendarAppDay, MeasurementsApp }
});
