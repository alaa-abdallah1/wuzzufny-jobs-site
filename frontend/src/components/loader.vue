<template>
  <div>
    <v-overlay v-if="fullPage" :color="loaderColor" :value="loader">
      <div v-if="type == 'pollets'" class="centerdiv">
        <ul>
          <li v-for="n in 6" :key="n"></li>
        </ul>
      </div>
      <v-progress-circular
        v-if="type == 'circle'"
        :size="$vuetify.breakpoint.xs ? 50 : 100"
        :width="5"
        color="mainColor"
        indeterminate
      ></v-progress-circular>
    </v-overlay>
  </div>
</template>
<script>
export default {
  props: {
    fullPage: {
      type: Boolean,
      default: true
    },
    loader: {
      type: Boolean,
      required: true
    },
    type: {
      type: String,
      validator: function(value) {
        return ["pollets", "circle"].indexOf(value) !== -1;
      },
      default: "circle"
    },
    loaderColor: {
      type: String
    }
  }
};
</script>
<style scoped>
.componentLodaing {
  height: 100%;
  width: 100%;
  position: absolute;
  margin: auto;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}

ul {
  display: flex;
}

ul li {
  list-style: none;
  height: 20px;
  width: 20px;
  background-color: red;
  margin: 0 4px;
  border-radius: 50%;
  animation: bounce 1s linear infinite;
}

@keyframes bounce {
  0% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-40px);
  }
  100% {
    transform: translateY(0px);
  }
}

ul li:nth-child(1) {
  animation-delay: 0.2s;
  background-color: #7c33f3;
}

ul li:nth-child(2) {
  animation-delay: 0.6s;
  background-color: #f700ba;
}

ul li:nth-child(3) {
  animation-delay: 0.1s;
  background-color: #ff287f;
}

ul li:nth-child(4) {
  animation-delay: 0.8s;
  background-color: #ff8152;
}

ul li:nth-child(5) {
  animation-delay: 0.5s;
  background-color: #ffc246;
}

ul li:nth-child(6) {
  animation-delay: 0.1s;
  background-color: #f9f871;
}
</style>
