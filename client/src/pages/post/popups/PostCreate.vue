<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="60%">
      <template v-slot:activator="{ on, attrs }">
        <v-btn text v-bind="attrs" v-on="on">
          <span>Write</span>
          <v-icon right>create</v-icon>
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="headline grey lighten-2" primary-title>{{category}} new post</v-card-title>

        <v-card-text>
          <v-form class="px-3" ref="form">
            <v-text-field
              label="title"
              v-model="post.title"
              prepend-icon="folder"
              :rules="titleRules"
            ></v-text-field>
            <v-textarea label="body" v-model="post.body" prepend-icon="create" :rules="bodyRules"></v-textarea>
          </v-form>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red" text @click="close">close</v-btn>
          <v-btn color="indigo" text @click="submit" :loading="loading">submit</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import Post from "@/models/post";
import UserService from "@/services/user.service";
export default {
  props: ["user", "category", "category_id"],
  commponents: {},
  data() {
    return {
      post: new Post("","","",this.category_id),
      dialog: false,
      titleRules: [
        v => !!v || "title is required",
        v => v.length >= 10 || "must be longer then 10"
      ],
      bodyRules: [
        v => !!v || "body is required",
        v => v.length >= 10 || "must be longer then 10"
      ],
      loading: false
    };
  },
  methods: {
    close() {
      this.dialog = false;
    },
    submit() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        console.log(this.post);
        UserService.savePost(this.post).then(
          response => {
            this.$router.go("/home");
          },
          error => {
            console.log(error.response);
          }
        );
        this.close();
        this.loading = false;
      }
    }
  }
};
</script>
