export const namespaced = true

export const state = {
  loading: true,
  type: 'circle'
}

export const mutations = {
  changeLoadingStatus(state, status) {
    state.loading = status
  },
  changeType(state, type) {
    state.type = type
  }
}

export const actions = {
  loadingStatus({ commit, dispatch }, status) {
    commit('changeLoadingStatus', status)
    // close popup if it opens
    dispatch(
      'popup/popupData',
      {
        show: false
      },
      { root: true }
    )
  },
  changeType({ commit }, type) {
    commit('changeType', type)
  }
}
