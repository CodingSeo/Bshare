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
            <v-carousel
              cycle
              height="200"
              hide-delimiter-background
              hide-delimiters
              show-arrows-on-hover
            >
              <v-carousel-item v-for="(slide, i) in slides" :key="i">
                <v-sheet height="100%">
                  <v-row class="fill-height" align="center" justify="center">
                    <!-- where info goes -->
                    <div class="display-3">{{ slide }} Slide</div>
                  </v-row>
                </v-sheet>
              </v-carousel-item>
            </v-carousel>
          </v-card>
          <v-divider></v-divider>

          <v-card class="my-3">
            <v-carousel
              cycle
              height="200"
              hide-delimiter-background
              hide-delimiters
              show-arrows-on-hover
            >
              <v-carousel-item v-for="(slide, i) in slides" :key="i">
                <v-sheet height="100%">
                  <v-row class="fill-height" align="center" justify="center">
                    <!-- where info goes -->
                    <div class="display-3">{{ slide }} Slide</div>

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
      slides: ["First", "Second", "Third", "Fourth", "Fifth"]
    };
  },
  created() {}
};
</script>
