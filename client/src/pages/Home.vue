`<template>
  <div class="home">
    <v-container class="my-5">
      <h1 class="subheading grey--text">Home</h1>
      <v-divider></v-divider>
      <v-layout col wrap>
        <v-flex>
          <v-card class="my-3">
            <v-card-actions>
              <v-btn text color="grey--text">
                Learn More
              </v-btn>
            </v-card-actions>
            <v-card-text>
              <div>Word of the Day</div>
              <p class="display-1 text--primary">
                be•nev•o•lent
              </p>
              <p>adjective</p>
              <div class="text--primary">
                well meaning and kindly.<br />
                "a benevolent smile"
              </div>
            </v-card-text>
          </v-card>

          <v-divider></v-divider>
          <v-card class="my-3">
            <v-card-title>
              <p class="display-1 pl-4 pt-2 grey--text">
                Most Viewed Posts
              </p>
            </v-card-title>
            <v-carousel
              cycle
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
                  <v-row class="pa-10 fill-height" align="center" justify="center">
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

          <v-card class="my-3">
            <v-card-title class="height=20">
              <p class="display-1  pl-4 pt-2  grey--text">
                Most Recent Posts
              </p>
            </v-card-title>
            <v-carousel
              cycle
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
                  <v-row class="pa-10 fill-height" align="center" justify="center">
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
export default {
  name: "Home",
  data() {
    return {
      MostViewedPosts: [],
      MostRecentPosts: []
    };
  },
  created() {
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
