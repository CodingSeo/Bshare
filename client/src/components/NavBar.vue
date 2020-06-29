<template>
  <nav>
    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer" class="grey--text"></v-app-bar-nav-icon>
      <router-link class="routerLink" to="/">
        <v-toolbar-title class="text-uppercase grey--text">
          <span class="font-weight-black">B</span>
          <span class="font-weight-light">Share</span>
        </v-toolbar-title>
      </router-link>
      <v-spacer></v-spacer>

      <router-link class="routerLink" to="/login">
        <v-btn text color="grey">
          <span>Login</span>
          <v-icon right>login</v-icon>
        </v-btn>
      </router-link>

      <router-link class="routerLink" to="/signup">
        <v-btn text color="grey">
          <span>Legister</span>
          <v-icon right>face</v-icon>
        </v-btn>
      </router-link>
    </v-app-bar>

    <v-navigation-drawer nav app v-model="drawer" class="indigo">
      <v-subheader mb5 left class="white--text mb-3" style="font-size:1em">Menu</v-subheader>

      <v-list>
        <v-list-item
          class="d-flex mb-6"
          v-for="link in links"
          :key="link.code"
          router
          :to="link.router"
        >
          <v-list-item-icon>
            <v-icon class="white--text">{{ link.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-content class="white--text">{{ link.title }}</v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </nav>
</template>

<script>
export default {
  name: "NavBar",
  components: {},
  created() {
    // using JSONPlaceholder
    // this.$http.get("/category").then(result => {
    //   console.log(result.data);
    //   this.links = result.data;
    // });
  },
  data() {
    return {
      result: [],
      drawer: false,
      links: [
        {
          icon: "home",
          title: "Home",
          code: null,
          router: "/"
        },
        {
          icon: "rate_review",
          title: "Book Review",
          code: 1,
          router: "/review"
        },
        {
          icon: "shopping_cart",
          title: "Book 구매",
          code: 2,
          router: "/purchase"
        },
        {
          icon: "storefront",
          title: "Book 판매",
          code: 3,
          router: "/selling"
        },
        {
          icon: "help",
          title: "Q/A",
          code: 4,
          router: "/help"
        }
      ]
    };
  }
};
</script>

