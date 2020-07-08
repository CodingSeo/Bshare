<template>
  <v-app class="grey lighten-4">
    <NavBar :login="loggedIn" :user="user_info" />
    <v-content class="mx-4 mb-4">
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
      auth: 'auth' 
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
.theme--light.v-application {
  background: #f5f5f5;
}
.routerLink {
  text-decoration: none;
}
.post.review {
  border-left: 4px solid rgb(65, 75, 221);
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
