import defaultSetting from '../../setting'
import SettingApi from '../../api/setting'

const { showSettings, fixedHeader, sidebarLogo, title } = defaultSetting

export const settings = {
    namespaced: true,
    state: {
        showSettings: showSettings,
        fixedHeader: fixedHeader,
        sidebarLogo: sidebarLogo,
        title: title,
        setting: {},
    },
    actions: {
        changeSetting({ commit }, data) {
            commit('CHANGE_SETTING', data)
        },
        saveSetting({ commit }, {code, params}) {
            return new Promise((resolve, reject) => {
                SettingApi.save(code, params).then(response => {
                    commit('SET_SETTING', response.setting)
                    resolve()
                }).catch(error => {
                    reject(error)
                })
            })
        },
        getSetting({ commit }, code) {
            return new Promise((resolve, reject) => {
                SettingApi.get(code).then(response => {
                    commit('SET_SETTING', response.setting)
                    resolve()
                }).catch(error => {
                    reject(error)
                })
            })
        }
    },
    mutations: {
        CHANGE_SETTING: (state, { key, value }) => {
            if (state.hasOwnProperty(key)) {
                state.key = value
            }
        },
        SET_SETTING: (state, setting) => {
            state.setting = setting
        }
    },
    getters: {
        title: state => state.title,
        logo: state => state.sidebarLogo,
        setting: state => state.setting,
    }
}