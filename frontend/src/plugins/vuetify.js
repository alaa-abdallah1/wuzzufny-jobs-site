import Vue from 'vue'
import Vuetify from 'vuetify'
import '@mdi/font/css/materialdesignicons.css'

Vue.use(Vuetify)

export default new Vuetify({
  icons: {
    iconfont: 'mdi'
  },
  theme: {
    dark: !!(
      localStorage.mode === undefined ||
      String(localStorage.mode).toLowerCase() == 'true'
    ),
    themes: {
      light: {
        error: '#ff3333',
        mainColor: localStorage.mainColor ? localStorage.mainColor : '#da7410'
      },
      dark: {
        error: '#ff3333',
        mainColor: localStorage.mainColor ? localStorage.mainColor : '#da7410'
      }
    }
  }
})
