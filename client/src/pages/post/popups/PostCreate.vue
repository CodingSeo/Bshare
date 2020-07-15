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
        <v-card-title class="headline grey lighten-2" primary-title>{{category}} New Post</v-card-title>
        <v-card-text>
          <v-form class="px-3" ref="form">
            <v-file-input
              class="mt-5"
              v-model="files"
              @change="onFilePicked"
              counter
              label="Images"
              :loading="imageloading"
              :rules="imageRules"
              accept="image/png, image/jpeg, image/bmp"
              loader-height="4"
              multiple
              placeholder="Select your images"
              prepend-icon="mdi-camera"
              outlined
              :show-size="1000"
            >
              <template v-slot:selection="{ index, text }">
                <v-chip color="indigo" dark label small>{{ text }}</v-chip>
              </template>
            </v-file-input>

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
      files: [],
      uploadedfiles: [],
      imageloading: false,
      post: new Post("", "", "", this.category_id),
      dialog: false,
      imageRules: [
        values =>
          !values ||
          !values.some(value => value.size > 2000000) ||
          "image size should be less than 2 MB!",
        values =>
          !values ||
          !values.some(value => value.type === "image/png") ||
          "file should be image files"
      ],
      titleRules: [v => !!v || "title is required"],
      bodyRules: [v => !!v || "body is required"],
      loading: false
    };
  },
  methods: {
    close() {
      this.dialog = false;
    },
    submit() {
      if (this.$refs.form.validate() && this.imageloading == false) {
        this.loading = true;
        UserService.savePost(this.post, this.uploadedfiles).then(
          response => {
            this.$router.push(`/${this.category}/post/${response.data.id}`);
          },
          error => {
            console.log(error.response);
          }
        );
        this.close();
        this.loading = false;
      }
    },

    pickFile() {
      this.$refs.image.click();
    },

    onFilePicked(files) {
      if (files[0] !== undefined) {
        if (
          files.length < 6 &&
          files.some(
            file => file.type === "image/png" || file.type === "image/jpeg"
          ) &&
          files.some(file => file.size < 2000000)
        ) {
          //start uploading
          this.imageloading = true;
          this.uploadedfiles = [];
          for (var i = 0; i < files.length; i++) {
            var fd = new FormData();
            fd.append("image", files[i]);
            var result = UserService.uploadImage(fd).then(result => {
              if (result == []) {
                this.files = [];
                this.uploadedfiles = [];
                this.imageloading = false;
              } else {
                console.log(result);
                this.uploadedfiles.push(JSON.stringify(result));
                if (this.uploadedfiles.length == files.length) {
                  this.imageloading = false;
                }
              }
            });
          }
        } else {
          this.files = [];
        }
      }
    }
  }
};
</script>
