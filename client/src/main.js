import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import axios from "axios"
// axios.defaults.baseURL = "/dev/";
axios.defaults.baseURL = "http://localhost:8000/dev/";
axios.defaults.withCredentials = true;

Vue.prototype.$http = axios;

Vue.config.productionTip = false
Vue.use(vuetify);

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')