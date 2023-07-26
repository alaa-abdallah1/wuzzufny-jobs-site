<template>
  <div>
    <v-card
      class="text-center noData d-flex flex-column not-found"
      style="justify-content: center; align-items: center;"
    >
      <v-icon class="mr-2 d-flex" x-large style=" position: relative; top: -4px"
        >mdi-note-alert-outline</v-icon
      >
      <h1>(404) Page NotFound</h1>
    </v-card>
  </div>
</template>
<style>
.not-found {
  width: 100%;
  height: 400px;
  position: relative;
}
</style>
