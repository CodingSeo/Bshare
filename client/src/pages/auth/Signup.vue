<template>
  <v-container fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md8>
        <template>
          <v-card class="elevation-12">
            <v-toolbar dark flat color="indigo">
              <v-toolbar-title>SIGN UP</v-toolbar-title>
            </v-toolbar>
            <v-form class="px-3" ref="form">
              <v-card-text>
                <v-text-field
                  prepend-icon="person"
                  v-model="user.name"
                  :counter="10"
                  :rules="nameRules"
                  label="name"
                  required
                ></v-text-field>
              </v-card-text>
              <v-card-text>
                <v-text-field
                  prepend-icon="alternate_email"
                  v-model="user.email"
                  :rules="emailRules"
                  label="email"
                  required
                ></v-text-field>
              </v-card-text>
              <v-card-text>
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
              <v-card-text>
                <v-text-field
                  v-model="user.password_confirmation"
                  prepend-icon="lock"
                  :append-icon="
                    password_confirmationShow ? 'mdi-eye' : 'mdi-eye-off'
                  "
                  :type="password_confirmationShow ? 'text' : 'password'"
                  :rules="password_confirmationRules"
                  label="password_confirmation"
                  @click:append="
                    password_confirmationShow = !password_confirmationShow
                  "
                ></v-text-field>
              </v-card-text>
              <v-divider light></v-divider>
              <v-card-actions>
                <v-btn rounded color="primary" dark @click="reset">Reset Form</v-btn>
                <v-spacer></v-spacer>
                <v-btn rounded color="indigo" dark @click="signup" :loading="loading">sign up</v-btn>
              </v-card-actions>
            </v-form>
          </v-card>
        </template>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  props: ["login", "user"],
  data() {
    return {
      loading: false,
      nameRules: [
        v => !!v || "Name is required",
        v => (v && v.length <= 10) || "Name must be less than 10 characters"
      ],
      emailRules: [
        v => !!v || "E-mail is required",
        v => /.+@.+\..+/.test(v) || "E-mail must be valid"
      ],
      passwordShow: false,
      passwordRules: [
        v => !!v || "password is required",
        v =>
          (v && v.length >= 10) || "password must be longer than 10 characters",
        v =>
          (v && v.length < 20) || "password must be shorter than 20 characters"
      ],
      password_confirmationShow: false,
      password_confirmationRules: [
        v => !!v || "password_confirmation is required",
        v =>
          v === this.user.password ||
          "password_confirmation must be equal to Password"
      ]
    };
  },
  created() {
    if (this.login) {
      this.$router.push("/");
    }
  },
  methods: {
    reset() {
      this.$refs.form.reset();
    },
    signup() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        this.$store.dispatch("auth/register", this.user).then(
          response => {
            this.$router.push("/");
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
  //   console.log(
  //           this.password,
  //           this.email,
  //           this.password_confirmed,
  //           this.name
  //         );
  //   this.$http
  //           .post(`/auth/register`, {
  //             name: this.name,
  //             email: this.email,
  //             password: this.password,
  //             password_confirmation: this.password_confirmed
  //           })
  //           .then(result => {
  //             console.log(result);
  //             this.loading = false;
  //             this.$router.push("/");
  //           });
};
</script>
