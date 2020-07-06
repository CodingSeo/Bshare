<template>
  <div class="help">
    <v-container class="my-5">
      <h1 class="subheading grey--text">Q/N</h1>
      <v-divider></v-divider>
      <div>
        <v-expansion-panels multiple>
          <v-expansion-panel v-for="(panel, i) in panels" :key="i">
            <v-expansion-panel-header
              > {{ panel.title }}</v-expansion-panel-header
            >
            <v-expansion-panel-content>
              {{panel.content.body}}  Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui reprehenderit ullam minus quos, 
              exercitationem corrupti doloribus velit voluptatum adipisci 
              provident officiis delectus, libero rerum eveniet! Sunt veniam suscipit ducimus consequuntur.
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
  created() {
    //     category: (...)
    // comments: (...)
    // content: (...)
    // created_at: (...)
    // id: (...)
    // title: (...)
    // updated_at: (...)
    // user_id: (...)
    // view_count: (...)
    this.$http.get(`api/category/QnA`).then(result => {
      let content = result.data;
      this.panels = content;
      console.log(content);
    });
  },
  data() {
    return {
      panels: []
    };
  },
  methods: {}
};
</script>
