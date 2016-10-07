window._ = require('lodash');

require('moment');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');
require('bootstrap-daterangepicker');

import './helpers/vue-filters';

import Echo from './mixins/echo';
import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import VueTables from 'vue-tables'

import NavbarView from './components/NavbarView.vue'
import SidebarView from './components/dashboard/SidebarView.vue'
// import UserView from './components/dashboard/UserView.vue'
// import Fullcalendar from './components/dashboard/fullcalendar'

Vue.use(VueTables.client, {
    compileTemplates: true,
    highlightMatches: true,
    toMomentFormat: true,
    dateFormat: 'MM/DD/YYYY',
    filterByColumn: true,
    texts: {
        filter: "Search:"
    },
    datepickerOptions: {
        showDropdowns: true
    },
    //skin:''
});

Vue.use(VueResource);
Vue.use(VueRouter)

// A route component can also contain <router-view> to render
// nested children route components
const Parent = {
  template: `
    <div class="parent">
      <h2>Parent</h2>
      <router-view class="child"></router-view>
    </div>
  `
}

const Navbar = { template: NavbarView }
const Sidebar = { template: SidebarView }
const Default = { template: '<div>default</div>' }
const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }
const Baz = { template: '<div>baz</div>' }

const router = new VueRouter({
    mode: 'history',
    mixins: [Echo],
    routes: [
        { path: '/login', redirect: '/' },
        { path: '/', component: Parent,
            children: [
                // an empty path will be treated as the default, e.g.
                // components rendered at /parent: Root -> Parent -> Default
                { path: '', component: Default },

                // components rendered at /parent/foo: Root -> Parent -> Foo
                { path: 'foo', component: Foo },

                // components rendered at /parent/bar: Root -> Parent -> Bar
                { path: 'bar', component: Bar },

                // NOTE absolute path here!
                // this allows you to leverage the component nesting without being
                // limited to the nested URL.
                // components rendered at /baz: Root -> Parent -> Baz
                { path: '/foo', component: Foo }
            ]
        }
    ]
})

new Vue({
    router,
    template: `
        <div id="app">
            <h1>Nested Routes</h1>
            <ul>
                <li><router-link to="/parent">/parent</router-link></li>
                <li><router-link to="/parent/foo">/parent/foo</router-link></li>
                <li><router-link to="/parent/bar">/parent/bar</router-link></li>
                <li><router-link to="/foo">/foo</router-link></li>
            </ul>
            <router-view class="view"></router-view>
        </div>
    `
}).$mount('#app-dashboard')
