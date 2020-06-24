import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from "../components/auth/Login"
import Signup from "../components/auth/Signup"
import Home from "../components/Home"

Vue.use(VueRouter)


const routes = [
  {
    path: '/login',
    name: Login,
    component: Login
  },
  {
    path: '/signup',
    name: Signup,
    component: Signup
  },
  {
    path: '/home',
    name: Home,
    component:Home
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
