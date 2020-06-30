<template>
  <div class="reviewpost">
    <v-container class="my-5">
      <h1 class="subheading grey--text" v-text="title"></h1>
      <v-divider></v-divider>
      <!-- body -->
      <v-layout row wrap justify-end>
        <v-flex col-xs-8>
          <div class="subtitle-1 grey--text ml-5 mt-1 mb-2">
            view count : {{ view_count }}
          </div>
        </v-flex>
        <template v-if="isYours(user.email, user_id)">
          <v-btn @click="deletePost" text>
            <span>Delete</span>
            <v-icon right>delete</v-icon>
          </v-btn>
          <PostUpdate
            :post_id="post_id"
            :content="content"
            :title="title"
          ></PostUpdate>
        </template>
      </v-layout>
      <v-divider></v-divider>
      <div>
        <v-card flat min-height="400">
          <v-card-text>{{ content }}</v-card-text>
        </v-card>
      </div>
      <v-divider></v-divider>
      <v-flex>
        <p>where comment input goes</p>
      </v-flex>
      <v-divider></v-divider>
      <v-card
        class="pl-3 mb-2"
        flat
        v-for="comment in comments"
        :key="comment.id"
      >
        <v-layout row wrap class="pa-2">
          <v-flex xs12 md6>
            <div class="caption grey--text">content</div>
            <div>{{ comment.body }}</div>
          </v-flex>
          <v-flex xs4 sm3 md2>
            <div class="caption grey--text">Writer</div>
            <div>{{ comment.user_id }}</div>
          </v-flex>
          <v-flex xs4 sm3 md2>
            <div class="caption grey--text">Create At</div>
            <div>{{ comment.created_at }}</div>
          </v-flex>
          <!-- where i need to change -->
          <v-flex xs1 sm1 md1 v-if="isYours(user.email, user_id)">
            <v-btn small text>
              <span>Delete</span>
              <v-icon right>delete</v-icon>
            </v-btn>
            <CommentUpdate />
          </v-flex>
        </v-layout>
        <v-divider></v-divider>
        <v-card
          class="pl-10 mb-2"
          flat
          v-for="replie in comment.replies"
          :key="replie.id"
        >
          <v-layout row wrap class="pa-2">
            <v-flex xs12 md6>
              <div class="caption grey--text">content</div>
              <div>{{ replie.body }}</div>
            </v-flex>
            <v-flex xs6 sm4 md2>
              <div class="caption grey--text">Writer</div>
              <div>{{ replie.user_id }}</div>
            </v-flex>
            <v-flex xs6 sm4 md2>
              <div class="caption grey--text">Create At</div>
              <div>{{ replie.created_at }}</div>
            </v-flex>
            <!-- where i need to change -->
            <v-flex xs1 sm1 md1 v-if="isYours(user.email, user_id)">
              <v-btn small text>
                <span>Delete</span>
                <v-icon right>delete</v-icon>
              </v-btn>
              <CommentUpdate />
            </v-flex>
          </v-layout>
          <v-divider></v-divider>
        </v-card>
      </v-card>
    </v-container>
  </div>
</template>

<script>
import PostUpdate from "@/pages/post/popups/PostUpdate.vue";
import CommentUpdate from "@/pages/post/popups/CommentUpdate.vue";
import UserService from "@/services/user.service";
export default {
  name: "reviewpost",
  components: {
    PostUpdate,
    CommentUpdate
  },
  props: ["login", "user", "postid"],
  created() {
    this.$http.get(`api/posts/${this.postid}`).then(result => {
      let content = result.data;
      this.post_id = content.id;
      this.title = content.title;
      this.content = content.content.body;
      this.comments = content.comments;
      this.created_at = content.created_at;
      this.user_id = content.user_id;
      this.view_count = content.view_count;
      console.log(content);
    });
  },
  data() {
    return {
      post_id: "",
      title: "",
      content: "",
      created_at: "",
      user_id: "",
      view_count: "",
      comments: []
    };
  },
  methods: {
    isYours(userid, writerid) {
      return userid === writerid;
    },
    deletePost() {
      UserService.deletePost(this.post_id).then(
        response => {
          this.$router.push("/review");
        },
        error => {
          console.log(error.response);
        }
      );
    }
  }
};
</script>
