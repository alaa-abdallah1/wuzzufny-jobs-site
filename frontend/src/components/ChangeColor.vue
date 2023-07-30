<template>
  <div
    class="sittings"
    :style="`background-color: ${!mode ? '#fff' : '#333'}  `"
  >
    <!-- <input
      class="mainColor inputColor"
      type="color"
      @input="showColor"
      v-model="color"
    /> -->
    <div class="text-center">
      <img
        id="mode-icon"
        :src="
          mode
            ? require(`@/assets/images/light-mode.png`)
            : require(`@/assets/images/dark-mode.png`)
        "
        alt="ERR"
        @click="changeMode"
      />
    </div>
    <ul id="color">
      <li
        v-for="(color, index) in colors"
        :key="index"
        :style="`background-color: ${color}`"
        @click="changeColor(color)"
      ></li>
    </ul>
    <!-- <span @click="showColor('#da1010')">red</span> -->
    <!-- <v-switch
      v-model="mode"
      :label="mode ? 'Light Mode' : 'Dark Mode'"
      color="mainColor"
      class="ml-2"
      @click="changeMode"
    >
    </v-switch> -->
    <v-icon color="">mdi-memory</v-icon>
  </div>
</template>

<script>
let root = document.documentElement

export default {
  data: () => ({
    publicPath: process.env.BASE_URL,
    color: '#fff',
    mode: false,
    colors: [
      '#ffdd00',
      '#0fdb2e',
      '#e10d09',
      '#0abee6',
      '#db0fc0',
      '#da7410',
      '#1872f2',
      '#14ccb4'
    ]
  }),
  methods: {
    changeColor(color) {
      this.color = color
      this.showColor()
    },
    changeMode() {
      this.mode = !this.mode
      localStorage.mode = this.mode

      if (this.mode) {
        this.$vuetify.theme.dark = true
      } else {
        this.$vuetify.theme.dark = false
      }
    },
    showColor() {
      // update the main Color In local storage
      localStorage.mainColor = this.color

      // update the main Color In Vuetify Theme
      this.$vuetify.theme.themes.dark.mainColor = this.color
      this.$vuetify.theme.themes.light.mainColor = this.color

      // update the main Color In Succ File
      root.style.setProperty('--mainColor', this.color)
    }
    // changeMode() {
    //   // update the main Color In local storage
    //   // update the main Color In Vuetify Theme
    //   // this.$store.dispatch("fireChangeDarkMode");
    //   localStorage.mode = this.mode;

    //   if (this.mode) {
    //     this.$vuetify.theme.dark = true;
    //   } else {
    //     this.$vuetify.theme.dark = false;
    //   }
    // }
  },
  created() {
    // check if mode Exist in Local storage
    if (localStorage.mode) {
      if (String(localStorage.mode).toLowerCase() == 'true') {
        this.$vuetify.theme.dark = true
        this.mode = true
      } else {
        this.$vuetify.theme.dark = false
        this.mode = false
      }
    } else {
      localStorage.setItem('mode', true)
      this.mode = true
    }

    //check if mainColor Exist in Local storage
    if (localStorage.mainColor) {
      // update color in input
      this.color = localStorage.mainColor
      // update the main Color In Succ File
      root.style.setProperty('--mainColor', this.color)
    } else {
      localStorage.setItem('mainColor', '')
      root.style.setProperty('--mainColor', '#edc307')
    }
  }
}
</script>

<style scoped>
#color {
  list-style: none;
  margin: 0;
  padding: 0;
}

#color li {
  display: inline-block;
  padding: 10px;
  margin: 5px;
  width: 20px;
  height: 20px;
}

#mode-icon {
  width: 50px;
}

#color li:hover,
#mode-icon:hover {
  cursor: pointer;
}

.sittings {
  position: fixed;
  top: 100px;
  right: -140px;
  width: 150px;
  z-index: 2;
  transition: all 1s;
  border: 1px solid #ccc;
  border-radius: 5px;
  background: rgba(0, 0, 0, 0.7);
  padding: 10px;
}
.sittings .inputColor {
  width: 100%;
  height: 50px;
  cursor: pointer;
  outline: none !important;
  border-radius: 5px;
  border: none !important;
}
.sittings .inputColor::after {
  content: 'change color';
  color: aliceblue;
  position: absolute;
  top: 10px;
  right: 22px;
}
.sittings i {
  position: absolute;
  right: 145px;
  top: 60px;
  font-size: 30px;
}
.sittings:hover {
  right: -10px;
}
</style>
