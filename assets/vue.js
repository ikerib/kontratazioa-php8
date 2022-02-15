import './styles/vue.scss'

import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import axios from 'axios';
import VueAxios from "vue-axios";
Vue.use(VueAxios, axios);


import App from './components/App'
import VueLuxon from "vue-luxon";
Vue.use(VueLuxon, {
    input: {
        zone: "utc",
        format: "iso"
    },
    output: {
        zone: "utc",
        format: "YYYY-MM-DD HH:mm:ss",
        locale: "eu",
    }
});

import vueRouter from 'vue-router'
import routes from "./components/router";
const router = new vueRouter({

    routes,
    linkActiveClass: "active",
    linkExactActiveClass: "active"
});
Vue.use(vueRouter);

import store from './components/store'
import VueBootstrapDatetimePicker from 'vue-bootstrap-datetimepicker'
// Initialize as global component
Vue.component('date-picker', VueBootstrapDatetimePicker);

// Using font-awesome 5 icons
$.extend(true, $.fn.datetimepicker.defaults, {
    icons: {
        time: 'far fa-clock',
        date: 'far fa-calendar',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'fas fa-calendar-check',
        clear: 'far fa-trash-alt',
        close: 'far fa-times-circle'
    }
});

new Vue({
    components: { App },
    template: "<App/>",
    router,
    store: store
}).$mount("#app");

