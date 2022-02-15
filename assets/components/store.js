import Vue from "vue"
import Vuex from "vuex"
import axios from "axios";
import { DateTime } from "luxon";
import moment from "moment";
Vue.use(Vuex)
import Swal from "sweetalert2";
export default new Vuex.Store({

    state:{
        isLoading: false,
        selectedRow: '',
        notitications: [],
        notification: null
    },
    mutations: {
        SELECT_ROW: function(state, payload) {
            state.selectedRow = payload;
        },
        SET_IS_LOADING(state, isLoading) {
            state.isLoading = isLoading
        },
        SET_NOTIFICATIONS(state, payload) {
            state.notitications = payload;
        }
    },
    getters: {
        allNotifications: (state) => {
            return state.notitications;
        },
        getNotifyById: (state) => (id) => {
            console.log("STORE ID")
            console.log(id);
            console.log(state.notitications);
            return state.notitications.find(n => n.id === parseInt(id))
        }
    },
    actions: {
        async fetchNotifications({ commit }) {
            commit('SET_IS_LOADING', true);
            if (this.state.selectedRow !== '') {
                const url = routing.generate('api_lotes_notifications_get_subresource', { id: this.state.selectedRow })+".json";
                await axios.get(url)
                    .then(res => {
                        const notifications = res.data;
                        commit('SET_NOTIFICATIONS', notifications);
                        commit('SET_IS_LOADING', false);
                    }).catch(err => {
                        commit('SET_IS_LOADING', false);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Zerbait oker joan da.',
                            footer: err.message
                        });
                    });
            }
        },
        async addNotification(context,data) {
            console.log(data);
            const dat =DateTime.fromFormat(data.noiz,'DD/MM/YYYY HH:mm:ss');
            const da = moment(data.noiz, 'DD/MM/YYYY HH:mm:ss');
            data.noiz = da.format('YYYY-MM-DD HH:mm:ss');
            const url = routing.generate('api_notifications_post_collection');
            await axios.post(url,data)
                .then (res => {
                    context.dispatch('fetchNotifications');
                }).catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Zerbait oker joan da.',
                        footer: err.message
                    });
                });
        },
        async putNotification(context, data) {
            const dat =DateTime.fromFormat(data.noiz,'DD/MM/YYYY HH:mm:ss');
            const da = moment(data.noiz, 'DD/MM/YYYY HH:mm:ss');
            data.noiz = da.format('YYYY-MM-DD HH:mm:ss');
            const url = routing.generate('api_notifications_put_item', { 'id': data.id});
            await axios.put(url,data)
                .then (res => {
                    context.dispatch('fetchNotifications');
                }).catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Zerbait oker joan da.',
                        footer: err.message
                    });
                });
        },
        async deleteNotification ( context, data ) {
            const url = routing.generate('api_notifications_delete_item', { 'id': data});
            await axios.delete(url,data)
                .then (res => {
                    context.dispatch('fetchNotifications');
                }).catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Zerbait oker joan da.',
                        footer: err.message
                    });
                });
        }
    }

})
