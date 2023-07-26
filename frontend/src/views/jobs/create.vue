<template>
  <v-card>
    <h1 class="headline text-center font-weight-bold py-4 mainColor--text">
      Create New Job
    </h1>
    <CustomForm
      :fields="fields"
      :formBtn="formBtn"
      :request="request"
      :loader="true"
      @success="create"
    />
  </v-card>
</template>

<script>
import CustomForm from "@/components/CustomForm.vue";
import { mapGetters } from "vuex";

export default {
  components: {
    CustomForm
  },
  metaInfo() {
    return {
      title: `Create Job`
    };
  },
  data: () => ({}),
  computed: {
    ...mapGetters(["countriesData", "skillsData"]),
    formBtn() {
      return {
        text: "Create",
        bindOptions: {
          type: "submit",
          color: "mainColor"
        }
      };
    },
    fields() {
      return [
        {
          component: "v-text-field",
          label: "Job Name",
          key: "name",
          value: "",
          rules: "required|min:10|max:40",
          bindOptions: {
            required: true,
            placeholder: "Write Job's Name",
            counter: 40
          },
          width: { xs: 12, sm: 6, lg: 4 }
        },
        {
          component: "v-text-field",
          label: "Job Title",
          key: "title",
          value: "",
          rules: "required|min:10|max:60",
          bindOptions: {
            required: true,
            placeholder: "Write Job's Title",
            counter: 60
          },
          width: { xs: 12, sm: 6, lg: 4 }
        },
        {
          component: "v-textarea",
          label: "Job Description",
          key: "description",
          value: "",
          rules: "required|min:200|max:2000",
          bindOptions: {
            required: true,
            placeholder: "Write job Description",
            counter: 2000
          },
          width: { xs: 12, sm: 12, lg: 12 }
        },
        {
          component: "v-textarea",
          label: "Qualification",
          key: "qualifications",
          value: "",
          rules: "required|min:100|max:2000",
          bindOptions: {
            required: true,
            placeholder: "Write job Employee Qualification",
            counter: 2000
          },
          width: { xs: 12, sm: 12, lg: 12 }
        },
        {
          component: "v-select",
          label: " Job Country",
          key: "country",
          value: "",
          rules: "required",
          bindOptions: {
            items: this.countriesData,
            menuProps: { offsetY: true },
            chips: true
          },
          width: { xs: 12, sm: 6, lg: 4 }
        },
        {
          component: "v-text-field",
          label: "From ? Years OF Experience",
          key: "experience->from",
          value: null,
          rules: "required|integer|min_value:0",
          bindOptions: {
            placeholder: "From ? Years OF Experience",
            counter: 2,
            type: "number",
            min: 0
          },
          width: { xs: 6, sm: 3, lg: 2 }
        },
        {
          component: "v-text-field",
          label: "To ? Years OF Experience",
          key: "experience->to",
          value: null,
          rules: "required|integer|min_value:1",
          bindOptions: {
            placeholder: "To ? Years OF Experience",
            type: "number",
            min: 1
          },
          width: { xs: 6, sm: 3, lg: 2 }
        },
        {
          component: "v-text-field",
          label: "Job Address",
          key: "address",
          value: "",
          rules: "required|min:20|max:100",
          bindOptions: {
            placeholder: "Write Job's Address",
            counter: 100
          },
          width: { xs: 12, sm: 12, lg: 8 }
        },
        {
          component: "v-select",
          label: "job Skills",
          key: "skills",
          value: "",
          rules: "required|min: 2|max:50",
          bindOptions: {
            items: this.skillsData,
            menuProps: { offsetY: true },
            deletableChips: true,
            multiple: true,
            seachable: true,
            chips: true
          },
          width: { xs: 12, sm: 6, lg: 4 }
        },
        {
          component: "v-select",
          label: "Job Type",
          key: "type",
          value: "",
          rules: "required",
          bindOptions: {
            items: ["Full Time", "Part Time"],
            menuProps: { offsetY: true },
            chips: true
          },
          width: { xs: 12, sm: 6, lg: 4 }
        },

        {
          component: "v-text-field",
          label: "Company Name",
          key: "companyName",
          value: "",
          rules: "required|min:10|max:40",
          bindOptions: {
            placeholder: "Write Company Name",
            counter: 40
          },
          width: { xs: 12, sm: 6, lg: 4 }
        },
        {
          component: "v-text-field",
          label: "Salary",
          key: "salary",
          value: "",
          rules: "required|integer|min_value:1",
          bindOptions: {
            placeholder: "Write Salary In Dollars",
            type: "number",
            min: 1,
            prependIcon: "$"
          },
          width: { xs: 12, sm: 6, lg: 4 }
        },
        {
          component: "v-textarea",
          label: "About Company",
          key: "aboutCompany",
          value: "",
          rules: "required|min:50|max:1000",
          bindOptions: {
            required: true,
            placeholder: "Write Brief About Company",
            counter: 1000,
            rows: "5"
          },
          width: { xs: 12, sm: 12, lg: 12 }
        },
        {
          component: "v-file-input",
          label: "Company Logo",
          key: "logo",
          value: null,
          rules: "required",
          bindOptions: {
            placeholder: "Insert Company Logo",
            prependIcon: "mdi-camera",
            chips: true
          },
          width: { xs: 12, sm: 12, lg: 12 }
        },
        {
          component: "v-switch",
          label: "Availability",
          key: "status",
          value: 1,
          bindOptions: {
            ["true-value"]: 1,
            ["false-value"]: 0
          },
          width: { xs: 12, sm: 12, lg: 12 }
        }
      ];
    },
    request() {
      return {
        method: "post",
        url: `api/job/create`,
        data: this.user
      };
    }
  },
  methods: {
    create(res) {
      this.$router.push({ name: "job/view", params: { id: res.data.job.id } });
    }
  },
  created() {
    this.$store.commit("getSkillsAndCountriesData");
  }
};
</script>
