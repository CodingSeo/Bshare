<template>
<!-- https://vuetifyjs.com/en/components/forms/#forms -->
  <v-container fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md8>
        <template>
          <v-card class="elevation-12">
            <v-toolbar dark color="indigo">
              <v-toolbar-title>Legister</v-toolbar-title>
            </v-toolbar>
            <v-form ref="form" v-model="valid" lazy-validation>
              <v-card-text>
                <v-text-field
                  v-model="name"
                  :counter="10"
                  :rules="nameRules"
                  label="name"
                  required
                ></v-text-field>
              </v-card-text>
              <v-card-text>
                <v-text-field
                  v-model="email"
                  :rules="emailRules"
                  label="email"
                  required
                ></v-text-field>
              </v-card-text>
              <v-card-text>
                <v-text-field
                  v-model="password"
                  :append-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="passwordShow ? 'text' : 'password'"
                  :rules="passwordRules"
                  :counter="10"
                  label="password"
                  @click:append="passwordShow = !passwordShow"
                ></v-text-field>
              </v-card-text>
              <v-card-text>
                <v-text-field
                  v-model="password_confirmed"
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
                <v-btn
                  rounded
                  color="indigo"
                  dark
                  :disabled="!valid"
                  @click="validate"
                >
                  Validate
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn rounded color="primary" dark @click="reset">
                  Reset Form
                </v-btn>
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
  data: () => ({
    valid: false,
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
      v => (v && v.length >= 10) || "password must be longer than 20 characters"
    ],
    password_confirmed: "",
    password_confirmedShow: false,
    password_confirmedRules: [
      v => !!v || "password_confirmed is required",
      v =>
        v.equal(this.password) || "Password_confirmed must be equal to Password"
    ],
    lazy: false
  }),
  methods: {
    validate() {
      this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    }
  }
};
</script>
<style>
button.v-btn[disabled] {
  opacity: 1;
}
</style>
