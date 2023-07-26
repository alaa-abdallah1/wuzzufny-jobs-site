<template>
  <v-row justify="center">
    <v-dialog v-model="showBox" persistent max-width="290">
      <v-card>
        <slot>{{ msg }}</slot>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="hide">
            No
          </v-btn>
          <v-btn color="green darken-1" text @click="process">
            Yes
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  props: {
    msg: {
      type: String
    },
    showBox: {
      type: Boolean,
      required: true
    }
  },
  methods: {
    hide() {
      this.$forceUpdate(() => {
        return (this.showBox = false);
      });
    },
    process() {
      this.$emit("confirm");
      this.showBox = false;
    }
  }
};
</script>
