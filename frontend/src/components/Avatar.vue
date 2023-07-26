<template>
  <div>
    <center>
      <div class="profile-pic mb-4">
        <!-- <img
          class="profile-pic round"
          :src="localValue ? localValue : defaultImg()"
        /> -->
      </div>

      <input type="file" ref="file" hidden @change="fileValue" />
      <v-btn small elevation="2" color="primary" @click="clickInput">
        Change
      </v-btn>
      {{ data }}
    </center>
  </div>
</template>

<script>
export default {
  props: {
    // value: {
    //   type: String
    // }
  },
  data() {
    return {
      data: ""
    };
  },
  computed: {
    // localValue: {
    //   get() {
    //     // return this.value;
    //   },
    //   set(val) {
    //     return val;
    //   }
    // }
  },
  methods: {
    clickInput() {
      this.$refs.file.click();
    },
    fileValue(file) {
      this.data = file.target.files[0];
      this.$emit("file", file.target.files[0]);
      // if (file) {
      //   this.value = URL.createObjectURL(file.target.files[0]);
      // } else {
      //   this.fileUrl = null;
      // }
    },
    defaultImg() {
      return require("@/assets/images/profile-pic.jpg");
    }
  }
};
</script>

<style scoped>
.profile-pic {
  position: relative !important;
}
.profile-pic img {
  width: 150px;
  height: 150px;
  border: 0.5px solid #eee;
  border-radius: 50%;
}
</style>
