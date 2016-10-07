import './helpers/vue-filters';
import Echo from 'laravel-echo';
import moment from 'moment';
import Vue from 'vue';

import Navbar from './components/NavbarView.vue'
import CurrentTime from './components/monitor/current-time';
import DiversifiedCalendar from './components/monitor/diversified-calendar';
import ServiceBureauCalendar from './components/monitor/service-bureau-calendar';
import LastFm from './components/monitor/last-fm';
import Vonage from './components/monitor/vonage';
import Freshdesk from './components/monitor/freshdesk';
import Payment from './components/monitor/payment';
import DiversifiedTask from './components/monitor/diversified-task';
import ServiceBureauTask from './components/monitor/service-bureau-task';

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: dashboard.pusherKey,
});

moment.locale('en', {
    calendar: {
        lastDay: '[Yesterday]',
        sameDay: '[Today]',
        nextDay: '[Tomorrow]',
        lastWeek: '[last] dddd',
        nextWeek: 'dddd',
        sameElse: 'LL',
    },
});

// Vue.transition('fade', {
//     enterClass: 'fadeInDown',
//     leaveClass: 'faceOutUp'
// });

new Vue({

    el: '#app-layout',

    components: {
        Navbar,
        CurrentTime,
        DiversifiedCalendar,
        ServiceBureauCalendar,
        LastFm,
        Vonage,
        Freshdesk,
        Payment,
        DiversifiedTask,
        ServiceBureauTask,
    },

});
