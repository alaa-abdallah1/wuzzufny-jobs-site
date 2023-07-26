import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import vuetify from "./plugins/vuetify";
import VeeValidate from "./plugins/VeeValidate";
import axios from "axios";
import VueAxios from "vue-axios";

// use Confirm Box as a global component
import Confirm from "./components/Confirm";
Vue.component("Confirm", Confirm);
// use Loader as a global component
import Skeleton from "./components/Skeleton";
Vue.component("Skeleton", Skeleton);

import VueMeta from "vue-meta";
Vue.use(VueMeta);
// import Echo from "laravel-echo";

// window.Pusher = require("pusher-js");

// window.Echo = new Echo({
//   broadcaster: "pusher",
//   key: "4e5adcd48a20cddf7789",
//   cluster: "mt1",
//   forceTLS: true
// });

export const bus = new Vue();

Vue.use(VueAxios, axios);
Vue.config.productionTip = false;
new Vue({
  router,
  store,
  vuetify,
  VeeValidate,
  created() {},
  render: h => h(App)
}).$mount("#app");
