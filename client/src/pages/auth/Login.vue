<template>
  <v-container fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md8>
        <v-form>
          <v-card class="elevation-12">
            <v-toolbar dark color="indigo">
              <v-toolbar-title>Login</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <v-text-field
                v-model="username"
                prepend-icon="person"
                name="login"
                label="Login"
                type="text"
              ></v-text-field>

              <v-text-field
                v-model="password"
                prepend-icon="lock"
                name="password"
                label="Password"
                type="password"
              ></v-text-field>
            </v-card-text>
            <v-divider light></v-divider>
            <v-card-actions>
              <v-btn to="/register" rounded color="indigo" dark>Sign up</v-btn>
              <v-spacer></v-spacer>
              <v-btn rounded color="primary" dark @click.prevent="login()">
                Login
                <v-icon>keyboard_arrow_right</v-icon>
              </v-btn>
            </v-card-actions>
            <v-divider light></v-divider>
            <v-card-actions>
              <!-- hiworks button should be to the full scaling -->
              <v-btn  to="/hiwork_redirect" color="blue" dark>Hiworks Login</v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: "Login",
  data: () => ({
    username: "",
    password: ""
  }),
  mounted() {}
};
</script>
