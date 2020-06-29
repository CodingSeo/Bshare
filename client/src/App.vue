<template>
  <v-app class="grey lighten-4">
    <NavBar v-bind:login="login" v-bind:user="user" />
    <v-content class="mx-4 mb-4">
      <router-view v-bind:login="login" v-bind:user="user"></router-view>
    </v-content>
  </v-app>
</template>
<script>
import NavBar from "@/components/NavBar";
import User from "@/models/user";
export default {
  name: "App",
  components: {
    NavBar
  },
  computed: {
    loggedIn() {
      return this.$store.state.auth.status.loggedIn;
    }
  },
  created() {
    if (this.loggedIn) {
      this.login = true;
      this.user = this.$store.state.auth.user.user_info;
    }
  },
  data: () => ({
    login: false,
    user: new User()
  })
};
</script>

<style>
.theme--light.v-application {
  background: #f5f5f5;
}
.routerLink {
  text-decoration: none;
}
.post.review {
  border-left: 4px solid indigo;
}
.post.complete {
  border-left: 4px solid tomato;
}
.post.ongoing {
  border-left: 4px solid greenyellow;
}

.v-chip.complete {
  background: tomato !important;
}
.v-chip.ongoing {
  background: greenyellow !important;
}
</style>
