<template>
    <v-card elevation="12" width="pa-12">
      <v-navigation-drawer floating permanent>
        <v-list-item-content>
          <v-list-item-title class="title">
            {{home}}
          </v-list-item-title>
          <v-list-item-subtitle>
            {{subtext}}
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
        <v-list dense rounded>
          <v-list-item v-for="item in items" :key="item.title" link>
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
    </v-card>
</template>

<script>
export default {
  name: "Nav",
  components: {},
  mounted() {},
  data() {
    return {
      home: "Bshare",
      subtext:"Welcome",
      items: [
        { title: "Book Review" },
        { title: "Book Selling" },
        { title: "Book Purchase" },
        { title: "Q/A" }
      ]
    };
  }
};
</script>
