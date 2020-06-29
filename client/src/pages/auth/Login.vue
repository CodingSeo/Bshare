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
                  v-model="email"
                  :rules="emailRules"
                  label="email"
                  required
                ></v-text-field>

                <v-text-field
                  v-model="password"
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
              <v-btn rounded color="primary" dark @click="login()">
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
  data: () => ({
    email: "",
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+\..+/.test(v) || "E-mail must be valid"
    ],
    password: "",
    passwordShow: false,
    passwordRules: [v => !!v || "password is required"]
  }),
  methods: {
    login() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        console.log(this.password, this.email);
        this.loading = false;
      }
    }
  }
};
</script>
