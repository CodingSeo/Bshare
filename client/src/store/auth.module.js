import AuthService from "@/services/auth.service";
import User from "@/models/user";
const user = JSON.parse(localStorage.getItem("user"));
const initialState = user
  ? {
      status: {
        loggedIn: true
      },
      user: user.user_info
    }
  : {
      status: {
        loggedIn: false
      },
      user: new User()
    };

export const auth = {
  namespaced: true,
  state: initialState,
  actions: {
    login({ commit }, user) {
      return AuthService.login(user).then(
        user => {
          commit("loginSuccess", user);
          return Promise.resolve(user);
        },
        error => {
          commit("loginFailure");
          return Promise.reject(error);
        }
      );
    },
    logout({ commit }) {
      AuthService.logout();
      commit("logout");
    },
    register({ commit }, user) {
      return AuthService.register(user).then(
        response => {
          commit("registerSuccess");
          return Promise.resolve(response.data);
        },
        error => {
          commit("registerFailure");
          return Promise.reject(error);
        }
      );
    },
    oauthLogin({ commit }, userinfo) {
      AuthService.oauthLogin(userinfo);
      commit("loginSuccess", userinfo);
      return userinfo;
    }
  },
  mutations: {
    loginSuccess(state, user) {
      state.status.loggedIn = true;
      state.user = user.user_info;
    },
    loginFailure(state) {
      state.status.loggedIn = false;
      state.user = new User();
    },
    logout(state) {
      state.status.loggedIn = false;
      state.user = new User();
    },
    registerSuccess(state) {
      state.status.loggedIn = false;
    },
    registerFailure(state) {
      state.status.loggedIn = false;
    }
  }
};
