import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../pages/Home";
import Login from "../pages/auth/Login";
import Signup from "../pages/auth/Signup";
import Review from "../pages/post/Review";
import Post from "../pages/post/Post";
import Selling from "../pages/post/Selling";
import Purchase from "../pages/post/Purchase";
import Help from "../pages/post/Help";
Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: Home
  },
  {
    path: "/home",
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
    path: "/BookReview",
    name: "review",
    component: Review,
  },
  {
    path: "/BookReview/:postid",
    props: true,
    name: "Post",
    component: Post
  },
  {
    path: "/BookBuying",
    name: "purchase",
    component: Purchase
  },
  {
    path: "/BookBuying/:postid",
    props: true,
    name: "Buyingpost",
    component: Post
  },
  {
    path: "/BookSelling",
    name: "selling",
    component: Selling
  },
  {
    path: "/BookSelling/:postid",
    props: true,
    name: "sellingpost",
    component: Post
  },
  {
    path: "/QnA",
    name: "help",
    component: Help
  },
  {
    path: '*',
    redirect: '/'
  }
];

const router = new VueRouter({
  mode: "hash",
  base: process.env.BASE_URL,
  routes
});

export default router;
