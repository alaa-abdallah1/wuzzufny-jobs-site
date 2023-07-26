<template>
  <v-card elevation="10" class="text-center" style="width: 100%;">
    <v-card-text>
      <v-btn
        v-for="(icon, index) in icons"
        :key="index"
        class="mx-2"
        :href="icon.href"
        icon
      >
        <v-icon size="24px">
          {{ icon.name }}
        </v-icon>
      </v-btn>
    </v-card-text>

    <v-card-text class="pt-0">
      Thank you for using our job site to find your next career opportunity. We
      wish you all the best in your job search!.
    </v-card-text>

    <v-divider></v-divider>

    <v-card-text class="">
      {{ new Date().getFullYear() }} — <strong><em>Wuzzufny</em></strong>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    icons: [
      {
        href: "https://www.linkedin.com/in/alaa-abdallah1/",
        name: "mdi-linkedin",
      },
      {
        href: "https://github.com/alaa-abdallah1",
        name: "mdi-github",
      },
    ],
  }),
}
</script>

<style scoped>
/* footer {
  position: fixed !important;
  bottom: 0 !important  ;
} */
</style>
