<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="80%">
      <template v-slot:activator="{ on, attrs }">
        <v-btn small text v-bind="attrs" v-on="on">
          <span>Update</span>
          <v-icon  right>update</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="headline lighten-2" primary-title></v-card-title>
        <v-card-text>
          <v-form class="px-3" ref="form">
            <v-text-field
              label="comment"
              v-model="commentModel.body"
              prepend-icon="create"
              :rules="bodyRules"
            ></v-text-field>
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
import CommentModel from "@/models/commentmodel";
import UserService from "@/services/user.service";
export default {
  props: ["comment_id", "body","postid"],
  commponents: {},
  data() {
    return {
      commentModel: new CommentModel(this.comment_id, this.postid, this.body,"",""),
      dialog: false,
      bodyRules: [
        v => !!v || "body is required",
      ],
      loading: false
    };
  },
  methods: {
    close() {
      // this.$refs.form.reset();
      this.dialog = false;
    },
    submit() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        UserService.updateComments(this.commentModel).then(
          response => {
            this.$router.go(`/review/${this.postid}`);
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
