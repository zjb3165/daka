export const caution = {
    namespaced: true,
    state: {
        checked: true,
        cautionType: 1,
        time: '07:00',
    },
    actions: {
        toggleCheck({ commit }, { code, status }) {
            commit('SET_CHECKED', status)
        },
        setType({ commit }, type) {
            commit('SET_CAUTION_TYPE', type)
        },
        setTime({ commit }, { code, time }) {
            commit('SET_CAUTION_TIME', time)
        }
    },
    mutations: {
        SET_CHECKED: (state, status) => {
            state.checked = status
        },
        SET_CAUTION_TYPE: (state, type) => {
            state.cautionType = type
        },
        SET_CAUTION_TIME: (state, time) => {
            state.time = time
        }
    },
    getters: {
        checked: state => state.checked,
        type: state => state.cautionType,
        time: state => state.time,
    }
}