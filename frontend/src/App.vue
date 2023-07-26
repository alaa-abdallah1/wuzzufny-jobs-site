<template>
  <v-app>
    <Loader
      :loader="loader.loading"
      :loaderColor="$vuetify.theme.dark ? '#000' : '#fff'"
      :type="loader.type"
    />
    <Popup :popup="popup.popupData" />
    <div v-if="startPage">
      <nav>
        <Navbar />
      </nav>

      <ChangeColor />

      <v-main>
        <div
          class="d-flex flex-column"
          style="min-height: 98.8vh; justify-content: space-between;"
        >
          <transition name="slide-fade" mode="out-in">
            <router-view class="my-8 mx-2" />
          </transition>

          <Footer />
        </div>
      </v-main>
    </div>
  </v-app>
</template>

<script>
import Navbar from "./components/navbar";
import Footer from "./components/footer";
import ChangeColor from "./components/ChangeColor";
import Loader from "./components/loader";
import Popup from "./components/popup";

import { mapState, mapMutations, mapActions } from "vuex";
export default {
  name: "App",
  data() {
    return {
      viewLoader: true
    };
  },
  components: {
    Navbar,
    Footer,
    ChangeColor,
    Loader,
    Popup
  },
  computed: {
    ...mapState(["loader", "popup", "startPage"])
  },
  methods: {
    ...mapMutations(["startPageStatus"]),
    ...mapActions({
      loadingStatus: "loader/loadingStatus",
      changeType: "loader/changeType"
    })
  },
  created() {
    this.changeType("pollets");
    // Add a response interceptor that logout if the token is fake
    this.axios.interceptors.response.use(
      response => response,
      error => {
        if (error.response.status === 401) {
          this.startPageStatus(true);
          this.$store.commit("logout");
          this.loadingStatus(false);
        }
        if (error.response.status === 404) {
          this.$router.push({ name: "notFound" });
          this.loadingStatus(false);
        }
        return Promise.reject(error);
      }
    );

    // send those headers when app created !
    // this.axios.defaults.baseURL = "https://a4ta8al.herokuapp.com";
    this.axios.defaults.baseURL = "http://127.0.0.1:8000";
    this.axios.defaults.headers.common["Accept"] = "application/json";
    this.axios.defaults.headers.common["Accept"] =
      "application/vnd.heroku+json; version=3";
    if (localStorage.getItem("token")) {
      this.axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("token");
      this.$store.commit("getUserData");
    } else {
      this.startPageStatus(true);
      this.loadingStatus(false);
      this.changeType("circle");
    }
  }
  // watch: {
  //   $route(to) {
  //     document.title = to.meta.title || "Wuzzufny";
  //   }
  // }
};
</script>

<style>
@import "./assets/css/main.css";

/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all 0.8s ease;
}
.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>
