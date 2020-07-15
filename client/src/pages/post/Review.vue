<template>
  <div class="review">
    <v-container class="my-5">
      <h1 class="subheading indigo--text">Book Review</h1>
      <v-divider></v-divider>
      <!-- body -->
      <v-layout row wrap justify-end>
        <v-flex shrink>
          <!-- setting router to review making -->
          <div v-if="!login">
            <router-link class="routerLink" to="/login">
              <v-btn text>
                <span>Write</span>
                <v-icon right>create</v-icon>
              </v-btn>
            </router-link>
          </div>
          <div v-else>
            <PostCreate :user="user" :category="category" :category_id="category_id" />
          </div>
        </v-flex>
      </v-layout>
      <v-divider></v-divider>
      <!-- list -->
      <!-- id,user_id,title,view_count,created,link,href -->
      <v-card
        class="pl-3 mb-2"
        flat
        v-for="post in posts"
        :key="post.id"
        router
        :to="`/${category}/post/${post.id}`"
      >
        <v-layout row wrap :class="`pa-3 post review`">
          <v-flex xs12 md6>
            <div class="caption grey--text">postName</div>
            <div>{{post.title}}</div>
          </v-flex>
          <v-flex xs6 sm4 md2>
            <div class="caption grey--text">Writer</div>
            <div>{{post.user_id}}</div>
          </v-flex>
          <v-flex xs6 sm4 md2>
            <div class="caption grey--text">Create At</div>
            <div>{{post.created}}</div>
          </v-flex>
          <v-flex xs2 sm2 md2>
            <div class="caption grey--text">View Count</div>
            <div>{{post.view_count}}</div>
          </v-flex>
        </v-layout>
        <v-divider></v-divider>
      </v-card>
      <!-- pagenate -->
      <div class="text-center mt-3">
        <v-pagination :length="last_page" color="indigo"></v-pagination>
      </div>
    </v-container>
  </div>
</template>

<script>
import PostCreate from "@/pages/post/popups/PostCreate.vue";
export default {
  name: "Review",
  components: {
    PostCreate
  },
  props: ["login", "user"],
  created() {
    //organize?
    this.$http.get(`api/category/${this.category_id}/posts`).then(result => {
      let content = result.data;
      this.current_page = content.current_page;
      this.last_page = content.last_page;
      this.next_page_url = content.next_page_url;
      this.posts = content.data;
      console.log(content);
    });
  },
  data: () => ({
    category: "BookReview",
    category_id: 1,
    per_page: "",
    current_page: "",
    last_page: 0,
    next_page_url: "",
    total: "",
    //id,user_id,title,view_count,created,link,href
    posts: []
  })
};
</script>
