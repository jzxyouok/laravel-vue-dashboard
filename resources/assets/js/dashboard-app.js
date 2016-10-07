window._ = require('lodash')

require('moment')

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery')

require('bootstrap-sass')
require('bootstrap-daterangepicker')

import './helpers/vue-filters'

import NProgress from 'nprogress'
import Echo from './mixins/echo'
import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

import Dashboard from './components/dashboard/DashboardView.vue'
import Navbar from './components/NavbarView.vue'
import Sidebar from './components/dashboard/SidebarView.vue'
import UserView from './components/dashboard/UserView.vue'
import FullCalendar from './components/dashboard/FullCalendarView.vue'

var VueTables = require('vue-tables-2')
var bus = require('vue-tables-2/lib/bus');

Vue.use(VueTables.client, {
    compileTemplates: true,
    highlightMatches: true,
    // toMomentFormat: true,
    // dateFormat: 'MM/DD/YYYY',
    filterByColumn: true,
    filterable: true,
    texts: {
        filter: "Search:"
    },
    datepickerOptions: {
        showDropdowns: true
    },
    skin: 'table-striped table-bordered table-hover'
})

Vue.use(VueResource)
Vue.use(VueRouter)

const Default = { template: '<div>default</div>' }

const router = new VueRouter({
    mode: 'history',
    mixins: [Echo],
    routes: [
        {
            path: '/login',
            redirect: '/'
        },
        {
            path: '/',
            components: {
                default: Default
            }
        },
        {
            path: '/users',
            components: {
                default: UserView
            },
        },
        {
            path: '/calendar/sb',
            components: {
                default: FullCalendar
            },
        },
    ]
})

Vue.http.interceptors.push(function (request, next) {
    NProgress.start();

    next(function (response) {
        NProgress.done();
        return response;
    });
})

new Vue({
    router,
    components: {
        Navbar,
        Sidebar
    },
    template: `
        <div id="app">
            
            <navbar></navbar>

            <div id="wrapper">
                <div id="page-content-wrapper">
                    <div class="dashboard-container container-fluid">
                        <sidebar></sidebar>

                        <section class="dashboard-content">

                            <router-view class="view" name="default"></router-view>

                        </section>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    `
}).$mount('#app-dashboard')
