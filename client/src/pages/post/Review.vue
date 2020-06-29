<template>
  <div class="review">
    <v-container class="my-5">
      <h1 class="subheading grey--text">Book Review</h1>
      <v-divider></v-divider>
      <!-- body -->
      <v-layout row wrap justify-end>
        <v-flex shrink>
          <!-- setting router to review making -->
          <router-link class="routerLink" to="/">
            <v-btn text>
              <span>Write</span>
              <v-icon right>create</v-icon>
            </v-btn>
          </router-link>
        </v-flex>
      </v-layout>
      <v-divider></v-divider>
      <!-- list -->
      <v-list text>
        <v-list-item-group color="indigo" class="mt-3 mb-3">
          <v-list-item v-for="post in posts" :key="post.id">
            <v-list-item-content>
              <!-- id,user_id,title,view_count,created,link,href -->
              <v-list-item-title>{{post.id}}</v-list-item-title>
              <v-list-item-subtitle>{{post.user_id}}</v-list-item-subtitle>
              <v-list-item-subtitle>{{post.title}}</v-list-item-subtitle>
              <v-list-item-subtitle>{{post.view_count}}</v-list-item-subtitle>
              <v-list-item-subtitle>{{post.created}}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
      <v-divider></v-divider>
      <!-- pagenate -->
      <div class="text-center mt-3">
        <v-pagination :length="last_page" color="indigo"></v-pagination>
      </div>
    </v-container>
  </div>
</template>

<script>
export default {
  name: "Review",
  created() {
    this.loading = true;
    this.$http.get(`/category/${this.category_id}/posts`).then(result => {
      let content = result.data;
      this.category_id = content.category_id;
      this.current_page = content.current_page;
      this.last_page = content.last_page;
      this.next_page_url = content.next_page_url;
      this.posts = content.data;
      console.log(content);
      console.log(this.posts[1].links);
    });
  },
  data: () => ({
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

<style>