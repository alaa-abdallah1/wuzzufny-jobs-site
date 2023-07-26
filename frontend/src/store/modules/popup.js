export const namespaced = true

export const state = {
  popupData: {
    show: false,
    coloe: '',
    text: 'Write Your Message Here'
  }
}

export const mutations = {
  changepopupData(state, status) {
    state.popupData = status
  }
}

export const actions = {
  popupData({ commit }, status) {
    commit('changepopupData', status)
  }
}
