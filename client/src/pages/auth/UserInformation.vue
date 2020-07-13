<template>
  <div class="User Information">
    <v-container class="my-5">
      <h1 class="subheading grey--text">User Information</h1>
      <v-divider></v-divider>
      <v-layout column justify-center>
        <v-flex xs12>
          <v-card>
            <v-card-title primary-title>
              <div>
                <div class="headline">{{this.user.name}}</div>
                <span class="grey--text">{{this.user.email}}</span>
              </div>
            </v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn icon @click.native="show = !show" class="mr-10">
                more Info
                <v-icon>{{
                  show ? "keyboard_arrow_down" : "keyboard_arrow_up"
                }}</v-icon>
              </v-btn>
            </v-card-actions>
            <v-slide-y-transition>
              <v-card-text v-show="show">
                this is the place where another user information should go
                </v-card-text>
            </v-slide-y-transition>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import authHeader from "@/services/auth-header";
export default {
  props: ["login", "user"],
  created() {
    if (!this.login) {
      this.$router.push("/home");
    } else {
      console.log(this.user);
    }
  },
  data: () => ({
    show: false
  }),
  methods: {}
};
</script>
