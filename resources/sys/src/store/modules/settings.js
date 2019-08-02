import defaultSetting from '../../setting'

const { showSettings, fixedHeader, sidebarLogo, title } = defaultSetting

export const settings = {
    namespaced: true,
    state: {
        showSettings: showSettings,
        fixedHeader: fixedHeader,
        sidebarLogo: sidebarLogo,
        title: title,
    },
    actions: {
        changeSetting({ commit }, data) {
            commit('CHANGE_SETTING', data)
        }
    },
    mutations: {
        CHANGE_SETTING: (state, { key, value }) => {
            if (state.hasOwnProperty(key)) {
                state.key = value
            }
        }
    },
}