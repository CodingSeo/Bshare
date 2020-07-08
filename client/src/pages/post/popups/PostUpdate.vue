<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="80%">
      <template v-slot:activator="{ on, attrss }">
        <v-btn text v-bind="attrss" v-on="on">
          <span>Update</span>
          <v-icon right>update</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="headline grey lighten-2" primary-title>{{title}} update post</v-card-title>
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
          <v-btn color="indigo" text @click="PostUpdatesubmit" :loading="loading">submit</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import Post from "@/models/post";
import UserService from "@/services/user.service";
export default {
  props: ["postid", "title","content"],
  commponents: {},
  data() {
    return {
      post: new Post(this.postid, this.title, this.content,""),
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
    PostUpdatesubmit() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        UserService.updatePost(this.post).then(
          response => {
            this.$router.push(`/BookReview`);
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
