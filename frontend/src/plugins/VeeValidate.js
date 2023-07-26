import Vue from "vue";
import VeeValidate from "vee-validate";
import { Validator } from "vee-validate";

import VeeValidateLaravel from "vee-validate-laravel";

Vue.use(VeeValidateLaravel);
Vue.use(VeeValidate, {
  inject: true,
  fieldsBagName: "veeFields",
  events: "input|blur",
  behavior: "eager",
  statusEvents: {
    pristine: "blur",
    invalid: "change",
    valid: "blur"
  }
});

const dictionary = {
  en: {
    attributes: {
      ["experience->from"]: "Experience from",
      ["experience->to"]: "Experience To"
    }
  }
  // custom: {
  //   name: {
  //     required: "Your email is empty"
  //   }
  // }
};
const dict = {
  custom: {
    // name: {
    //   required: () => "Your name is empty"
    // }
  }
};

Validator.localize("en", dict);
// or use the instance method
// this.$validator.localize("en", dict);
Validator.localize(dictionary);
