<template>
  <v-text-field
    :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
    :type="show ? 'text' : 'password'"
    @click:append="show = !show"
    v-model="localValue"
    v-bind="$attrs"
  ></v-text-field>
</template>
<script>
export default {
  props: ["value"],
  data() {
    return {
      show: false
    };
  },
  computed: {
    localValue: {
      get() {
        return this.value;
      },
      set(val) {
        this.$emit("input", val);
      }
    }
  },
  methods: {
    update(value) {
      this.$emit("input", value);
    }
  }
};
</script>
