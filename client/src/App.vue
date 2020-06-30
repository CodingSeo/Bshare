<template>
  <v-app class="grey lighten-4">
    <NavBar :login="login" :user="user" />
    <v-content class="mx-4 mb-4">
      <router-view :login="login" :user="user"></router-view>
    </v-content>
  </v-app>
</template>
<script>
import NavBar from "@/components/NavBar";
import User from "@/models/user";
import {mapState} from 'vuex'
export default {
  name: "App",
  components: {
    NavBar
  },
  computed: {
    ...mapState([
      login => state.auth.status.loggedIn,
      user => (state.auth.user.user_info)?
          state.auth.user.user_info:new User()
    ]),
  },
  created(){
    console.log(this.user);
  },
  data: () => ({
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
