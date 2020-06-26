<template>
  <div class="help">
    <v-container class="my-5">
      <h1 class="subheading grey--text">Q/N</h1>
      <v-divider></v-divider>
      <div>
        <div class="text-center d-flex pb-4">
          <div>{{ panel }}</div>
        </div>

        <v-expansion-panels v-model="panel" multiple>
          <v-expansion-panel v-for="(item, i) in items" :key="i">
            <v-expansion-panel-header
              >Header {{ item }}</v-expansion-panel-header
            >
            <v-expansion-panel-content>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
              enim ad minim veniam, quis nostrud exercitation ullamco laboris
              nisi ut aliquip ex ea commodo consequat.
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </div>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Help",
  data() {
    return {
      panel: [],
      items: 5
    };
  },
  methods: {}
};
</script>
