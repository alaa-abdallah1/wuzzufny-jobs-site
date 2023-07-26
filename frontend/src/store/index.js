import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import * as loader from "./modules/loader";
import * as popup from "./modules/popup";
import router from "./../router/index.js";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: "",
    startPage: false,
    countries: "",
    skills: ""
  },
  getters: {
    loggedIn(state) {
      return !!state.user;
    },
    countriesData(state) {
      if (state.countries) {
        return state.countries.map(country => country.name);
      } else {
        return [];
      }
    },
    skillsData(state) {
      if (state.skills) {
        return state.skills.map(skill => skill.name);
      } else {
        return [];
      }
    }
  },
  mutations: {
    userData(state, user) {
      state.user = user;
      localStorage.setItem("token", user.api_token);
      axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("token");
    },
    getUserData(state) {
      axios.get("api/userData").then(res => {
        this.commit("userData", res.data);
        state.loader.loading = false;
        state.startPage = true;
        this.commit("loader/changeType", "circle");
      });
    },
    updateUserData(state, user) {
      state.user = user;
    },
    startPageStatus(state, status) {
      state.startPage = status;
    },
    getSkillsAndCountriesData(state) {
      axios.get("api/countriesAndSkillsData").then(res => {
        state.countries = res.data.countries;
        state.skills = res.data.skills;
      });
    },
    logout(state) {
      state.user = "";
      localStorage.removeItem("token");
      axios.defaults.headers.common["Authorization"] = "";
      router.push({ name: "signIn" });
    }
  },
  actions: {
    updateUserData({ commit }, data) {
      commit("updateUserData", data);
    }
  },
  modules: {
    loader,
    popup
  }
});
