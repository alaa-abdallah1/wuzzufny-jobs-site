<template>
  <div class="text-center">
    <v-snackbar
      shaped
      top
      outlined
      right
      v-model="popup.show"
      :timeout="popup.timeout"
      transition="fab-transition"
      :color="popup.color ? popup.color : 'success'"
    >
      <span class="text-capitalize">{{ popup.text }}</span>

      <template v-slot:action="{ attrs }">
        <v-btn
          :color="'#fff'"
          small
          text
          v-bind="attrs"
          @click="popup.show = false"
        >
          x
        </v-btn>
      </template>
    </v-snackbar>
  </div>
</template>
<script>
export default {
  props: {
    popup: {
      show: {
        type: Boolean,
        default: true
      },
      text: {
        type: String
      },
      timeout: {
        type: Number,
        default: 50000
      },
      color: {
        type: String
      }
    }
  }
}
</script>

<style scoped>
.v-snack {
  top: 50px !important;
}
</style>
