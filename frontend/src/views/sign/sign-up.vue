<template>
  <div>
    <v-container class="">
      <v-layout row wrap>
        <v-col offset-sm="3" sm="6" class="mt-4">
          <v-card flat>
            <h1
              class="headline text-center font-weight-bold py-4 mainColor--text"
            >
              Sign Up
            </h1>
            <CustomForm
              :fields="fields"
              :formBtn="formBtn"
              :request="request"
              :loader="loader"
              @success="register"
            />
          </v-card>
        </v-col>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import CustomForm from '@/components/CustomForm.vue'

export default {
  components: {
    CustomForm
  },
  metaInfo() {
    return {
      title: `Sign Up`
    }
  },
  computed: {
    formBtn() {
      return {
        text: 'Sign Up',
        center: true,
        bindOptions: {
          type: 'submit',
          color: 'mainColor'
        }
      }
    },
    fields() {
      return [
        {
          component: 'v-text-field',
          label: 'Full Name',
          key: 'name',
          value: '',
          rules: 'required|min:4|max:20',
          bindOptions: {
            placeholder: 'Write Your Full Name',
            counter: 20
          },
          width: { xs: 12, sm: 12, lg: 6 }
        },
        {
          component: 'v-text-field',
          label: 'Your Email',
          key: 'email',
          value: '',
          rules: 'required|email',
          bindOptions: {
            placeholder: 'Write Your Email'
          },
          width: { xs: 12, sm: 12, lg: 12 }
        },
        {
          component: 'password',
          label: 'Password',
          key: 'password',
          value: null,
          rules: 'required|min:8',
          bindOptions: {
            type: 'password',
            placeholder: 'Write Your Password',
            ref: 'password'
          },
          width: { xs: 12, sm: 12, lg: 6 }
        },
        {
          component: 'password',
          label: 'Confirm Password',
          key: 'password_confirmation',
          value: null,
          rules: 'required|min:8|confirmed:password',
          bindOptions: {
            type: 'password',
            placeholder: 'Confirm Your Password',
            ['data-vv-as']: 'password'
          },
          width: { xs: 12, sm: 12, lg: 6 }
        }
      ]
    },
    request() {
      return {
        method: 'post',
        url: 'api/auth/register'
      }
    },
    loader: () => true
  },
  methods: {
    register() {
      this.$router.push({ name: 'signIn' })
    }
  }
}
</script>
