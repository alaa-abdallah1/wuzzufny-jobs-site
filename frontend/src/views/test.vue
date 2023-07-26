<template>
  <v-container class="">
    <v-layout row wrap>
      <v-col>
        <v-card>
          <v-card-title>
            Nutrition
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
            :search="search"
          ></v-data-table>
        </v-card>
      </v-col>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  props: {
    headers: {
      type: Object,
      required: true
    },
    items: {
      type: Object,
      required: true
    }
  },
  data() {
    return {};
  }
};
</script>
