`<template>
  <div class="home">
    <v-container class="my-5">
      <h1 class="subheading indigo--text">Home</h1>
      <v-divider></v-divider>
      <v-layout col wrap>
        <v-flex>
          <v-card class="my-3" height="30%">
            <v-card-text>
              <v-container>
                <v-layout row wrap>
                  <template v-if="this.RandomPostImages.length > 0">
                    <img
                      :src="RandomPostImages[0].src"
                      class="mx-10"
                      style="width:200px;height:200px;margin-left:auto;"
                    />
                  </template>
                  <template v-else>
                    <img
                      src="@/images/samplePic.png"
                      class="mx-10"
                      style="width:200px;height:200px;margin-left:auto;"
                    />
                  </template>

                  <v-flex col-xs-12>
                    <v-flex row-xs-8>
                      <div>{{ this.RandomPost.id }}</div>
                    </v-flex>
                    <v-flex row-xs-8>
                      <p class="display-1 text--primary">
                        {{ this.RandomPost.title }}
                      </p>
                    </v-flex>
                    <v-flex row-xs-8>
                      <div class="text--primary">
                        {{ this.RandomPost.body }}
                      </div>
                    </v-flex>
                  </v-flex>
                </v-layout>
                <router-link
                  class="routerLink"
                  :to="`/${this.RandomPostCategory}/post/1`"
                >
                  <v-btn text>
                    <span>To Page</span>
                  </v-btn>
                </router-link>
              </v-container>
            </v-card-text>
          </v-card>

          <v-divider></v-divider>
          <v-card class="my-3 indigo">
            <v-card-title>
              <p class="display-1 pl-4 pt-2 text-uppercase white--text">
                Most Viewed Posts
              </p>
            </v-card-title>
            <v-divider></v-divider>
            <v-carousel
              cycle
              light
              height="200"
              hide-delimiter-background
              hide-delimiters
              show-arrows-on-hover
            >
              <v-carousel-item
                v-for="post in this.MostViewedPosts"
                :key="post.id"
              >
                <v-sheet height="100%">
                  <v-row
                    class="pa-10 fill-height"
                    align="center"
                    justify="center"
                  >
                    <v-flex xs12 md6>
                      <div class="caption grey--text">postName</div>
                      <div>{{ post.title }}</div>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                      <div class="caption grey--text">Writer</div>
                      <div>{{ post.user_id }}</div>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                      <div class="caption grey--text">Create At</div>
                      <div>{{ post.created }}</div>
                    </v-flex>
                    <v-flex xs2 sm2 md2>
                      <div class="caption grey--text">View Count</div>
                      <div>{{ post.view_count }}</div>
                    </v-flex>
                  </v-row>
                </v-sheet>
              </v-carousel-item>
            </v-carousel>
          </v-card>
          <v-divider></v-divider>

          <v-card class="my-3 indigo">
            <v-card-title class="height=20">
              <p class="display-1 pl-4 pt-2 text-uppercase white--text">
                Most Recent Posts
              </p>
            </v-card-title>
            <v-divider></v-divider>
            <v-carousel
              cycle
              light
              height="200"
              hide-delimiter-background
              hide-delimiters
              show-arrows-on-hover
            >
              <v-carousel-item
                v-for="post in this.MostRecentPosts"
                :key="post.id"
              >
                <v-sheet height="100%">
                  <v-row
                    class="pa-10 fill-height"
                    align="center"
                    justify="center"
                  >
                    <v-flex xs12 md6>
                      <div class="caption grey--text">postName</div>
                      <div>{{ post.title }}</div>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                      <div class="caption grey--text">Writer</div>
                      <div>{{ post.user_id }}</div>
                    </v-flex>
                    <v-flex xs6 sm4 md2>
                      <div class="caption grey--text">Create At</div>
                      <div>{{ post.created }}</div>
                    </v-flex>
                    <v-flex xs2 sm2 md2>
                      <div class="caption grey--text">View Count</div>
                      <div>{{ post.view_count }}</div>
                    </v-flex>
                  </v-row>
                </v-sheet>
              </v-carousel-item>
            </v-carousel>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
import Post from "@/models/post";
export default {
  name: "Home",
  data() {
    return {
      MostViewedPosts: [],
      MostRecentPosts: [],
      RandomPostImages: [],
      RandomPostCategory:'',
      RandomPost: new Post()
    };
  },
  created() {
    this.$http.get(`api/posts/random`).then(result => {
      let content = result.data;
      this.RandomPost.id = content.user_id;
      this.RandomPost.body = content.content.body;
      this.RandomPost.title = content.title;
      this.RandomPostCategory = content.title;
      this.RandomPostImages = content.content.images;
      console.log(content);
    });
    this.$http.get(`api/posts/mostViews/5`).then(result => {
      let content = result.data;
      this.MostViewedPosts = content;
      console.log(content);
    });
    this.$http.get(`api/posts/mostRecents/5`).then(result => {
      let content = result.data;
      this.MostRecentPosts = content;
      console.log(content);
    });
  }
};
</script>
