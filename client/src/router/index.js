import Vue from 'vue'
import VueRouter from 'vue-router'
import Bshare from "../components/Bshare"
import login from "../components/auth/login"
import signup from "../components/auth/signup"

Vue.use(VueRouter)


const routes = [
  {
    path: '/',
    name: 'Bshare',
    component: Bshare
  },
  {
    path: '/login',
    name: login,
    component: login
  },
  {
    path: '/signup',
    name: signup,
    component: signup
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
