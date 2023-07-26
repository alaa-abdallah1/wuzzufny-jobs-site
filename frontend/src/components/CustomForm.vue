<template>
  <div>
    <v-form @submit.prevent="send">
      <v-container>
        <v-layout row wrap pb-4>
          <v-col
            v-for="(field, index) in fields"
            :key="index"
            :sm="field.width.sm"
            :cols="field.width.xs"
            v-bind="field.mainOptions"
            :class="[errors.has(field.key) ? 'errors' : '', field.mainClass]"
          >
            <component
              :is="field.component"
              :label="field.label"
              :name="field.key"
              @input="funcioncall(field.input, field.key, field.value)"
              @change="$emit('change', $event, field.key)"
              @click="funcioncall(field.click, field.key)"
              v-model="field.value"
              v-bind="[field.bindOptions, formBindOptions]"
              :color="errors.has(field.key) ? 'error' : 'mainColor'"
              v-validate="field.rules"
            />
            <component
              v-if="field.slot"
              :is="field.slot"
              :src="fileUrl ? fileUrl : field.AvatarSrc"
            />
            <span
              v-show="errors.has(field.key)"
              :class="errors.has(field.key) ? 'error--text' : 'mainColor--text'"
              >{{ errors.first(field.key) }}</span
            >
          </v-col>
          <v-col :class="['d-flex', { 'justify-center': formBtn.center }]">
            <v-btn v-bind="formBtn.bindOptions" color="mainColor" outlined
              ><span
                :class="
                  `${$vuetify.theme.dark ? 'white--text' : 'black--text'} ${
                    formBtn.color
                  }--text`
                "
                >{{ formBtn.text }}</span
              ></v-btn
            >
          </v-col>
        </v-layout>
      </v-container>
    </v-form>
  </div>
</template>

<script>
import {
  VTextField,
  VSwitch,
  VSelect,
  VTextarea,
  VFileInput
} from 'vuetify/es5/components'
import Password from './password'
import Avatar from './Avatar'
import { mapActions } from 'vuex'

export default {
  components: {
    VTextField,
    VSwitch,
    VSelect,
    VTextarea,
    VFileInput,
    Password,
    // Popup,
    Avatar
  },
  props: {
    fields: {
      type: Array,
      required: true
    },
    formBtn: {
      type: Object,
      required: true
    },
    formBindOptions: {
      type: Object
    },
    request: {
      type: Object,
      required: true
    },
    loader: {
      type: Boolean,
      default: false
    },
    popup: {
      type: Boolean,
      default: true
    },
    errorsMix: {
      type: Boolean,
      default: true
    }
  },
  data: () => ({
    loading: false
  }),
  computed: {},
  methods: {
    ...mapActions({
      loadingStatus: 'loader/loadingStatus',
      popupData: 'popup/popupData'
    }),

    input(fieldName, fieldValue) {
      this.$emit('input', fieldName, fieldValue)
    },

    funcioncall(eventType, fieldName, fieldValue) {
      if (eventType) {
        this[eventType](fieldName, fieldValue)
      } else {
        return ''
      }
    },

    send() {
      this.$validator.validateAll().then(res => {
        if (res) {
          if (this.request.url) {
            this.loadingStatus(true)
            var result = this.fields.map(function(field) {
              return { [field.key]: field.value }
            })
            var data = Object.assign({}, ...result)
            var formData = new FormData()
            Object.keys(data).forEach(key => {
              if (data[key] && Array.isArray(data[key])) {
                data[key].forEach(value => formData.append(`${key}[]`, value))
              } else {
                formData.append(key, data[key])
              }
            })
            this.axios({
              method: this.request.method,
              url: this.request.url,
              data: formData,
              headers: {
                'X-Requested-With': 'XMLHttpRequest'
              }
            })
              .then(res => {
                this.loadingStatus(false)
                if (this.popup) {
                  this.popupData({
                    show: true,
                    text: res.data.msg
                  })
                }
                this.$emit('success', res)
              })
              .catch(err => {
                this.loadingStatus(false)
                if (this.errorsMix) {
                  this.$setLaravelValidationErrorsFromResponse(
                    err.response.data
                  )
                } else {
                  this.popupData({
                    show: true,
                    color: '#c92114',
                    text: Object.values(err.response.data.errors)[0].toString()
                  })
                }
                this.$emit('error', err.response)
              })
          } else {
            this.$emit('function')
          }
        }
      })
    }
  },
  created() {}
}
</script>

<style>
/* This Style To Change Style For Errors */
.errors .v-text-field__slot label,
.errors .v-select__slot label,
.errors .mdi:before,
.errors .v-icon {
  color: red !important;
}
.errors .theme--light.v-text-field > .v-input__control > .v-input__slot:before,
.errors .theme--dark.v-text-field > .v-input__control > .v-input__slot:before {
  border-color: red !important  ;
}
</style>
