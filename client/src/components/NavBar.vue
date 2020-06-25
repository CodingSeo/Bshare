<template>
  <nav>
    <v-toolbar>
      <v-app-bar-nav-icon
        @click="drawer = !drawer"
        class="grey--text"
      ></v-app-bar-nav-icon>
      <router-link class="routerLink" to="/">
        <v-toolbar-title class="text-uppercase grey--text">
          <span class="font-weight-black">B</span>
          <span class="font-weight-light">Share</span>
        </v-toolbar-title>
      </router-link>

      <v-spacer></v-spacer>

      <v-btn text color="grey">
        <span>Login</span>
        <v-icon right>login</v-icon>
      </v-btn>

      <v-btn text color="grey">
        <span>Legister</span>
        <v-icon right>face</v-icon>
      </v-btn>
    </v-toolbar>
    <v-navigation-drawer app v-model="drawer" class="grey">
      <v-list>
        <v-list-item-group v-model="links">
          <v-list-item
            v-for="link in links"
            :key="link.code"
            router
            :to="link.router"
          >
            <v-list-item-icon>
              <v-icon class="white--text">{{ link.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>{{ link.title }} </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </nav>
</template>

<script>
export default {
  name: "NavBar",
  components: {},
  data() {
    return {
      drawer: false,
      link: 1,
      links: [
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
        { icon: "storefront", title: "Book 판매", code: 3, router: "/selling" },
        { icon: "help", title: "Q/A", code: 4, router: "/help" }
      ]
    };
  }
};
</script>

<style>
.routerLink {
  text-decoration: none;
}
</style>
