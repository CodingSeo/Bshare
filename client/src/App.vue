<template>
  <v-app>
    <Nav></Nav>
    <Home/>
  </v-app>
</template>
<script>
import Nav from "./components/nav/Nav";
import Home from "./components/Home";

export default {
  name: "App",
  components: {
    Nav,
    Home
  },
  data: () => ({}),
  mounted() {}
};
</script>
