<template>
  <div>
    <!-- <Loader :loader="loader" :fullPage="false" /> -->
    <v-container>
      <v-layout row wrap>
        <v-col offset-sm="3" sm="6" class="mt-4">
          <v-card flat>
            <h1
              class="headline text-center font-weight-bold py-4 mainColor--text"
            >
              Sign In
            </h1>
            <CustomForm
              :fields="fields"
              :formBtn="formBtn"
              :request="request"
              @success="login"
              :loader="true"
              :popup="false"
              :errorsMix="false"
            />
          </v-card>
        </v-col>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import CustomForm from "@/components/CustomForm.vue";

export default {
  components: {
    CustomForm
  },
  metaInfo() {
    return {
      title: `Sign In`
    };
  },
  computed: {
    formBtn() {
      return {
        text: "Sign In",
        center: true,
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
          label: "Email",
          key: "email",
          value: "",
          rules: "required|email",
          bindOptions: {
            type: "email",
            required: true,
            placeholder: "Write Your Email"
          },
          width: { xs: 12, sm: 12, lg: 6 }
        },
        {
          component: "password",
          label: "Password",
          key: "password",
          value: "",
          rules: "required|min:8",
          bindOptions: {
            type: "password",
            placeholder: "Write Your Password"
          },
          width: { xs: 12, sm: 12, lg: 4 }
        }
      ];
    },
    request() {
      return {
        method: "post",
        url: "api/auth/login"
      };
    }
  },
  methods: {
    login(response) {
      if (response.status === 200) {
        this.$store.commit("userData", response.data);
        this.$router.push({ name: "Home" });
      }
    }
  }
};
</script>
