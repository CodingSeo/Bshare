<template>
  <div class="reviewpost">
    <v-container class="my-5">
      <v-chip v-if="trade_status!==null" small :class="`${trade_status} white--text caption my-2`">{{trade_status}}</v-chip>
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
            :postid="postid"
            :content="content"
            :title="title"
            :category="category"
          ></PostUpdate>
          <v-chip v-if="trade_status!==null" small :class="`${trade_status} white--text caption my-2`">{{trade_status}}</v-chip>
        </template>
      </v-layout>
      <v-divider></v-divider>
      <div>
        <v-card flat min-height="400">
          <v-card-text>{{ content }}</v-card-text>
        </v-card>
      </div>
      <v-divider></v-divider>
      <v-layout row wrap justify-space-around>
        <v-flex xs10>
          <v-form ref="commentform">
            <v-text-field
              class="ml-5"
              v-model="commentModel.body"
              label="comment"
              :rules="commentRules"
            ></v-text-field>
          </v-form>
        </v-flex>
        <v-flex xs2>
          <template v-if="!login">
            <v-btn text class="mt-5 ml-2" router to="/login">
              <v-icon>create</v-icon>
            </v-btn>
          </template>
          <template v-else>
            <v-btn @click="createComment(commentModel)" text class="mt-5 ml-2">
              <v-icon>create</v-icon>
            </v-btn>
          </template>
        </v-flex>
      </v-layout>
      <v-divider></v-divider>
      <v-card
        class="pl-3 mb-2"
        flat
        v-for="comment in comments"
        :key="comment.id"
      >
        <v-layout row wrap class="pa-2">
          <v-flex xs12>
            <div class="caption grey--text">content</div>
            <div>{{ comment.body }}</div>
          </v-flex>
          <v-flex xs3>
            <div class="caption grey--text">Writer</div>
            <div>{{ comment.user_id }}</div>
          </v-flex>
          <v-flex xs3>
            <div class="caption grey--text">Create At</div>
            <div>{{ comment.created_at }}</div>
          </v-flex>
          <v-flex xs3 v-if="login">
            <CommentReplies
              :postid="postid"
              :comment_id="comment.id"
              :body="comment.body"
              :category="category"
            />
          </v-flex>
          <v-flex
            xs1
            v-if="isYours(user.email, comment.user_id)"
            class="d-flex align-center"
          >
            <v-btn small text @click="deleteComment(comment.id)">
              <span>Delete</span>
              <v-icon right>delete</v-icon>
            </v-btn>
            <CommentUpdate
              :postid="postid"
              :comment_id="comment.id"
              :body="comment.body"
              :category="category"
            />
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
            <v-flex xs12>
              <div class="caption grey--text">
                <v-icon small>subdirectory_arrow_right</v-icon>content
              </div>
              <div class="ml-5">{{ replie.body }}</div>
            </v-flex>
            <v-flex xs4>
              <div class="caption grey--text">Writer</div>
              <div>{{ replie.user_id }}</div>
            </v-flex>
            <v-flex xs4>
              <div class="caption grey--text">Create At</div>
              <div>{{ replie.created_at }}</div>
            </v-flex>
            <v-flex
              xs1
              v-if="isYours(user.email, replie.user_id)"
              class="d-flex align-center"
            >
              <v-btn small text @click="deleteComment(replie.id)">
                <span>Delete</span>
                <v-icon right>delete</v-icon>
              </v-btn>
              <CommentUpdate
                :postid="postid"
                :comment_id="replie.id"
                :body="replie.body"
                :category="category"
              />
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
import CommentReplies from "@/pages/post/popups/CommentReplies.vue";
import UserService from "@/services/user.service";
import CommentModel from "@/models/commentmodel";
export default {
  components: {
    PostUpdate,
    CommentUpdate,
    CommentReplies
  },
  props: ["login", "user", "postid", "category"],
  created() {
    this.$http.get(`api/posts/${this.postid}`).then(result => {
      let content = result.data;
      this.title = content.title;
      this.content = content.content.body;
      this.comments = content.comments;
      this.created_at = content.created_at;
      this.user_id = content.user_id;
      this.view_count = content.view_count;
      this.trade_status = content.trade_status;
      this.commentModel.postid = content.id;
      console.log(content);
    });
  },
  data() {
    return {
      title: "",
      content: "",
      created_at: "",
      user_id: "",
      view_count: "",
      trade_status: "",
      comments: [],
      commentModel: new CommentModel("", "", "", this.user.email),
      commentRules: [v => !!v || "comment is required"]
    };
  },
  methods: {
    isYours(userid, writerid) {
      return userid === writerid;
    },
    deletePost() {
      UserService.deletePost(this.postid).then(
        response => {
          this.$router.push(`/${this.category}`);
        },
        error => {
          console.log(error.response);
        }
      );
    },
    createComment(commentModel) {
      if (this.$refs.commentform.validate()) {
        UserService.createComment(commentModel).then(
          response => {
            this.$router.push(`/${this.category}`);
          },
          error => {
            console.log(error.response);
          }
        );
      }
    },
    deleteComment(commentid) {
      UserService.deleteComment(commentid).then(
        response => {
          this.$router.push(`/${this.category}`);
        },
        error => {
          console.log(error.response);
        }
      );
    }
  }
};
</script>
