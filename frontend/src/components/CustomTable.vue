<template>
  <v-container class="">
    <v-layout row wrap>
      <v-col>
        <v-card-title class="mainColor--text">
          {{ title }}
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
        <v-data-table
          :headers="headers"
          :items="items"
          v-bind="bindOptions"
          :search="search"
        ></v-data-table>
      </v-col>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  props: {
    title: {
      type: String
    },
    headers: {
      type: Array,
      required: true
    },
    items: {
      type: Array,
      required: true
    },
    bindOptions: {
      type: Object
    }
  },
  data() {
    return {
      search: ''
    }
  }
}
</script>
