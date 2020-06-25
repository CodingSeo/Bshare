<template>
  <v-app>
    <Nav/>
    <v-content>
      <router-view></router-view>
    </v-content>
  </v-app>
</template>
<script>
import NavBar from "@/components/NavBar";
import Home from "@/pages/Home";

export default {
  name: "App",
  components: {
    Nav,
    Home
  },
};
</script>
