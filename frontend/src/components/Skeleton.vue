<template>
  <v-container>
    <v-row>
      <v-col cols="12" md="12">
        <v-skeleton-loader v-bind="attrs" :type="type"></v-skeleton-loader>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {
  props: {
    type: {
      type: String,
      required: true
    }
  },
  data: () => ({
    attrs: {
      class: "mb-6",
      elevation: 2
    }
  })
};
</script>
