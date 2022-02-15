<template>
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="submit-form">
<!--        <form @submit.prevent="saveNotification(notification)">-->
          <div class="form-group">
            <label>Noiz aldatu</label>
            <date-picker v-model="date" :config="options"></date-picker>
          </div>
          <a v-on:click.stop="updateNotification" class="btn btn-success">Gorde</a>
<!--        </form>-->
      </div>
    </div>
    <div class="col-2"></div>
  </div>
</template>

<script>
// import 'bootstrap/dist/css/bootstrap.css';

// Import this component
import datePicker from 'vue-bootstrap-datetimepicker';

// Import date picker css
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
import {mapActions, mapGetters} from "vuex";
6
export default {
  name: "add-notifiation",
  data() {
    return {
      notification: null,
      notification_id: null,
      date: null,
      options: {
        // https://momentjs.com/docs/#/displaying/
        format: 'DD/MM/YYYY HH:mm:ss',
        sideBySide:true,
        inline:true,
        useCurrent: false,
        showClear: true,
        showClose: true,
        showTodayButton: true,
        locale: 'eu'
      },
      user: null,
      aaa: null,
      noiz: null
    };
  },
  methods: {
    updateNotification() {
      let data = {
        id: this.notification_id,
        noiz: this.date,
        user: "/api/users/" + this.user,
        lote: "/api/lotes/" + this.$store.state.selectedRow
      };
      this.putNotification(data);
      this.$router.push('/');
    },

    ...mapActions(['putNotification'])
  },
  mounted() {
    if (window.user) {
      this.user = window.user;
    }
    this.notification_id = this.$route.params.id;
    this.notification = this.$store.getters.getNotifyById(this.$route.params.id);
    this.noiz = this.notification.noiz;
    this.date = this.$luxon(this.notification.noiz, 'dd/MM/yyyy HH:mm:ss');
  },
  created: function () {

  }
};
</script>

<style>
.submit-form {
  /*max-width: 600px;*/
  margin: auto;
}

.bootstrap-datetimepicker-widget.wider {
  width: 100% !important;
}

</style>
