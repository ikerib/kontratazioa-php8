<template>
      <table class="table table-bordered">
        <thead>
        <tr class="d-flex">
          <th class="col-sm-4">#</th>
          <th class="col-sm-4">Noiz</th>
          <th class="col-sm-4"></th>
        </tr>
        </thead>
        <tbody>
          <tr class="d-flex" v-for="(notify,i) in notifications" :key="i">
            <td class="col-sm-4">{{notify.id}}</td>
            <td class="col-sm-4">{{notify.noiz | luxon('yyyy-MM-dd HH:mm:ss')}}</td>
            <td class="col-sm-4 text-center">
              <ul class="list-inline">
                <li class="list-inline-item">
                  <router-link class="btn btn-xs btn-default" v-bind:to="'/aldatu/'+notify.id"><i class="fa fa-edit"></i></router-link>
                </li>
                <li class="list-inline-item">
                  <a v-on:click.stop="ezabatu(notify.id)" class="btn btn-xs btn-danger"><i class="fa fa-trash-alt"></i></a>
                </li>
              </ul>
            </td>
          </tr>
        </tbody>
      </table>

</template>

<script>
import {mapActions, mapGetters} from "vuex";
import Swal from "sweetalert2";
export default {
  name: "NotificationList",
  computed: mapGetters({
    notifications: 'allNotifications'
  }),
  methods:{
    ezabatu: function (id) {
      Swal.fire({
        title: 'Ziur zaude?',
        text: "Onartuz gero ez du atzera bueltarik.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Bai, ezabatu!'
      }).then((result) => {
        if (result.isConfirmed) {
          this.deleteNotification(id);
        }
      })
    },
    ...mapActions(["fetchNotifications", "deleteNotification"]),
  },
}
</script>

<style scoped>

</style>
