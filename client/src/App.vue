<template>
  <v-app class="grey lighten-4">
    <NavBar :login="loggedIn" :user="user_info" />
    <v-content class="bsharebody pb-12">
      <router-view :login="loggedIn" :user="user_info"></router-view>
    </v-content>
  </v-app>
</template>
<script>
import NavBar from "@/components/NavBar";
import { mapState } from "vuex";
export default {
  name: "App",
  components: {
    NavBar
  },
  computed: {
    ...mapState({
      auth: "auth"
    }),
    loggedIn() {
      return this.auth.status.loggedIn;
    },
    user_info() {
      return this.auth.user;
    }
  }
};
</script>

<style>
.v-application {
  background: url(./images/bsharebackground.jpg);
}
.routerLink {
  text-decoration: #f5f5f5;
}
.post.review {
  border-left: 4px solid rgb(65, 75, 221);
}
.post.complete {
  border-left: 4px solid tomato;
}
.post.ongoing {
  border-left: 4px solid skyblue;
}

.v-chip.complete {
  background: tomato !important;
}
.v-chip.ongoing {
  background: skyblue !important;
}
.bsharebody {
  background: url(./images/bsharebackground.jpg) no-repeat center center fixed;

  -webkit-background-size: cover;

  -moz-background-size: cover;

  -o-background-size: cover;

  background-size: cover;
}
</style>
