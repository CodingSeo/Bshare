<template>
  <v-container fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md8>
        <v-form>
          <v-card class="elevation-12">
            <v-toolbar dark flat color="indigo">
              <v-toolbar-title>Login</v-toolbar-title>
            </v-toolbar>
            <v-form class="px-3" ref="form">
              <v-card-text>
                <v-text-field
                  prepend-icon="alternate_email"
                  v-model="user.email"
                  :rules="emailRules"
                  label="email"
                  required
                ></v-text-field>

                <v-text-field
                  v-model="user.password"
                  prepend-icon="lock"
                  :append-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="passwordShow ? 'text' : 'password'"
                  :rules="passwordRules"
                  label="password"
                  @click:append="passwordShow = !passwordShow"
                ></v-text-field>
              </v-card-text>
            </v-form>
            <v-divider light></v-divider>
            <v-card-actions>
              <!-- hiworks button should be to the full scaling -->
              <v-btn to="/hiwork_redirect" width="100%" color="blue" dark>Hiworks Login</v-btn>
            </v-card-actions>
            <v-divider light></v-divider>
            <v-card-actions>
              <v-btn to="/signup" rounded color="indigo" dark>
                <v-icon>person</v-icon>Sign up
              </v-btn>
              <v-spacer></v-spacer>
              <v-btn rounded color="primary" dark @click="loginAccount" :loading="loading">
                Login
                <v-icon>keyboard_arrow_right</v-icon>
              </v-btn>
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
  props: ["login", "user"],
  data: () => ({
    loading: false,
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+\..+/.test(v) || "E-mail must be valid"
    ],
    passwordShow: false,
    passwordRules: [v => !!v || "password is required"]
  }),
  //checking whether it's loggined or not
  created() {
    if (this.login) {
      this.$router.push("/");
    }
  },
  //
  methods: {
    loginAccount() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        this.$store.dispatch("auth/login", this.user).then(
          () => {
            this.$router.go(0);
          },
          error => {
            this.loading = false;
            this.message =
              (error.response && error.response.data) ||
              error.message ||
              error.toString();
          }
        );
      }
    }
  }
};
</script>
