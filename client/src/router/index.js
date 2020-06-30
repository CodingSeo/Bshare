import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../pages/Home";
import Login from "../pages/auth/Login";
import Signup from "../pages/auth/Signup";
import Review from "../pages/post/Review";
import ReviewPost from "../pages/post/ReviewPost";
import Selling from "../pages/post/Selling";
import Purchase from "../pages/post/Purchase";
import Help from "../pages/post/Help";
Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home
  },
  {
    path: "/login",
    name: "login",
    component: Login
  },
  {
    path: "/signup",
    name: "signup",
    component: Signup
  },
  {
    path: "/review",
    name: "review",
    component: Review,
  },
  {
    path: "/review/:postid",
    props: true,
    name: "reviewpost",
    component: ReviewPost
  },
  {
    path: "/purchase",
    name: "purchase",
    component: Purchase
  },
  {
    path: "/selling",
    name: "selling",
    component: Selling
  },
  {
    path: "/help",
    name: "help",
    component: Help
  },
  {
    path: '*',
    redirect: '/'
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
