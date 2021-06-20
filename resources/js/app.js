require("./bootstrap");
import Vue from "vue";

import router from "./router";

import axios from "axios";
import VueAxios from "vue-axios";

import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";

Vue.use(Vuetify);
Vue.use(VueAxios, axios);

import App from "./App.vue";

new Vue({
    vuetify: new Vuetify(),
    router,
    render: h => h(App)
}).$mount("#app");
