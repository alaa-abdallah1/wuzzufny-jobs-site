<template>
  <v-card>
    <h1 class="headline text-center font-weight-bold py-4 mainColor--text">
      Edit Your Profile
    </h1>

    <v-btn router to="/profile/view" text class="viewBtn">
      <v-icon elevation="2" color="mainColor">mdi-eye</v-icon>
    </v-btn>

    <CustomForm
      :fields="fields"
      :formBtn="formBtn"
      @success="update"
      @click="click"
      :request="request"
      :loader="true"
      :popup="true"
    />
  </v-card>
</template>

<script>
/* eslint-disable */
import CustomForm from "@/components/CustomForm.vue"
import {mapGetters, mapActions} from "vuex"

export default {
  components: {
    CustomForm,
  },
  metaInfo() {
    return {
      title: "Edit Profile",
    }
  },
  data() {
    return {
      user: {},
    }
  },
  computed: {
    ...mapGetters(["countriesData", "skillsData"]),
    formBtn() {
      return {
        text: "Edit",
        bindOptions: {
          type: "submit",
          color: "mainColor",
          ["v-on:click"]: "change",
        },
      }
    },
    fields() {
      return [
        {
          component: "v-text-field",
          label: "First Name",
          key: "name",
          value: this.user.name,
          rules: "required|min:6|max:20",
          bindOptions: {
            required: true,
            placeholder: "Write Your First Name",
            counter: 30,
          },
          width: {xs: 12, sm: 6, lg: 4},
        },
        {
          component: "v-text-field",
          label: "Your Email",
          key: "email",
          value: this.user.email,
          rules: "required|email",
          bindOptions: {
            rules: [],
            placeholder: "Write Your Email",
          },
          width: {xs: 12, sm: 6, lg: 4},
        },
        {
          component: "v-text-field",
          label: "Your Phone",
          key: "phone",
          value: this.user.phone,
          rules: "required",
          bindOptions: {
            type: "tel",
            placeholder: "Write Your Phone Number",
          },
          width: {xs: 12, sm: 6, lg: 4},
        },
        {
          component: "v-text-field",
          label: "Your Job",
          key: "job",
          value: this.user.job,
          rules: "required",
          bindOptions: {
            placeholder: "Write Your Job",
          },
          width: {xs: 12, sm: 6, lg: 4},
        },
        {
          component: "v-select",
          label: "Your Gender",
          key: "gender",
          value: this.user.gender,
          rules: "required",
          bindOptions: {
            items: ["male", "female"],
            menuProps: {offsetY: true},
          },
          width: {xs: 12, sm: 6, lg: 4},
        },
        {
          component: "v-select",
          label: "Your Country",
          key: "country",
          value: this.user.country,
          rules: "required",
          bindOptions: {
            items: this.countriesData,
            menuProps: {offsetY: true},
          },
          width: {xs: 12, sm: 6, lg: 4},
        },
        {
          component: "v-textarea",
          label: "Public Info About Yourself",
          key: "info",
          value: this.user.info,
          rules: "required|min:200|max:1000",
          bindOptions: {
            required: true,
            placeholder: "Write Brief About Yourself",
            counter: 1000,
            rows: "5",
          },
          width: {xs: 12, sm: 12, lg: 12},
        },
        {
          component: "v-select",
          label: "Your Skills",
          key: "skills",
          value: this.user.skills,
          rules: "required",
          bindOptions: {
            items: this.skillsData,
            menuProps: {offsetY: true},
            deletableChips: true,
            multiple: true,
            chips: true,
          },
          width: {xs: 12, sm: 12, lg: 12},
        },
        {
          component: "v-file-input",
          key: "avatar",
          value: null,
          bindOptions: {
            placeholder: "Update You Profile Picture",
          },
          width: {xs: 12, sm: 12, lg: 12},
        },
      ]
    },
    request() {
      return {
        method: "post",
        url: `api/profile/${this.user.id}`,
        // data: this.user
      }
    },
  },
  methods: {
    ...mapActions(["updateUserData"]),
    update(res) {
      if (res.status == 200) {
        this.updateUserData(res.data.user)
      }
    },
    change(e, fieldKey, x) {},
    click(fieldKey) {},
  },
  created() {
    this.$store.commit("getSkillsAndCountriesData")
    this.user = this.$store.state.user
  },
}
</script>
