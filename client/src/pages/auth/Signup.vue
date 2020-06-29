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
                  v-model="name"
                  :counter="10"
                  :rules="nameRules"
                  label="name"
                  required
                ></v-text-field>
              </v-card-text>
              <v-card-text>
                <v-text-field
                  prepend-icon="alternate_email"
                  v-model="email"
                  :rules="emailRules"
                  label="email"
                  required
                ></v-text-field>
              </v-card-text>
              <v-card-text>
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
              <v-card-text>
                <v-text-field
                  v-model="password_confirmed"
                  prepend-icon="lock"
                  :append-icon="
                    password_confirmedShow ? 'mdi-eye' : 'mdi-eye-off'
                  "
                  :type="password_confirmedShow ? 'text' : 'password'"
                  :rules="password_confirmedRules"
                  label="password_confirmed"
                  @click:append="
                    password_confirmedShow = !password_confirmedShow
                  "
                ></v-text-field>
              </v-card-text>
              <v-divider light></v-divider>
              <v-card-actions>
                <v-btn rounded color="indigo" dark @click="signup" :loading="loading">sign up</v-btn>
                <v-spacer></v-spacer>
                <v-btn rounded color="primary" dark @click="reset">Reset Form</v-btn>
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
  data() {
    return {
      loading: false,
      name: "",
      nameRules: [
        v => !!v || "Name is required",
        v => (v && v.length <= 10) || "Name must be less than 10 characters"
      ],
      email: "",
      emailRules: [
        v => !!v || "E-mail is required",
        v => /.+@.+\..+/.test(v) || "E-mail must be valid"
      ],
      password: "",
      passwordShow: false,
      passwordRules: [
        v => !!v || "password is required",
        v =>
          (v && v.length >= 10) || "password must be longer than 10 characters"
      ],
      password_confirmed: "",
      password_confirmedShow: false,
      password_confirmedRules: [
        v => !!v || "password_confirmed is required",
        v =>
          v === this.password || "Password_confirmed must be equal to Password"
      ],
      lazy: false
    };
  },
  methods: {
    reset() {
      this.$refs.form.reset();
    },
    signup() {
      if (this.$refs.form.validate()) {
        this.loading = true;
        console.log(
          this.password,
          this.email,
          this.password_confirmed,
          this.name
        );
        this.loading = false;
        // this.$router.push('/');
      }
    }
  }
};
</script>
