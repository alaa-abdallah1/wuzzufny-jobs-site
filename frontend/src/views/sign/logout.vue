<template>
  <div></div>
</template>
<script>
export default {
  created() {
    this.$store.state.user = "";
    localStorage.removeItem("token");
    this.axios.defaults.headers.common["Authorization"] = "";
    this.$router.push("sign-in");
  }
};
</script>
