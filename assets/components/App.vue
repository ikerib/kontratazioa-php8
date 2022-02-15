<template>
  <div class="col-12" v-show="this.$store.state.selectedRow">
<!--    <input id="txtRow" type="hidden" v-model="selectedRow">-->
    <input id="txtRow" type="hidden" :value="selectedRow" @input="selectedRowHandler">

    <div class="card card-secondary">
      <div class="card-header">
        <h5 class="card-title m-0">Jakinazpenak: </h5>
        <div class="card-tools">
          <router-link tag="button" class="btn btn-default" :to="{
            name: 'NotificationAdd',
            params: {selectedRow}
          }"><i class="fas fa-plus-circle"></i> Berria</router-link>
          <router-link tag="button" class="btn btn-default" :to="{
            name: 'NotificationList',
            params: {selectedRow:selectedRow}
          }"><i class="fas fa-list"></i> Zerrenda</router-link>
        </div>
      </div>
    </div>
    <div class="card-body">
      <router-view />
    </div>
  </div>
</template>

<script>
export default {
  name: "app",
  data: function() {
    return {
      isNew: false,
    }
  },
  computed: {
    selectedRow() {
      return this.$store.state.selectedRow;
    }
  },
  methods: {
    selectedRowHandler(event) {
      if (event.target.value !== "") {
        this.$store.commit('SELECT_ROW', event.target.value);
        this.$store.dispatch('fetchNotifications');
      }
    }
  }
};
</script>
<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
