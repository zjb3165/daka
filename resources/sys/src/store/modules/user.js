import UserApi from '../../api/user'
import { getToken, setToken, removeToken } from '../../utils/auth'

let token = getToken()

export const users = {
    state: {
        user: {},
        token: token.token,
        expires: token.expires,
        passwordUpdated: false,
    },
    actions: {
        login({ commit }, userInfo) {
            const { username, password } = userInfo
            UserApi.login(username, password)
                .then(function(response){
                    commit('SET_USERINFO', response.user)
                    commit('SET_TOKEN', {token: response.token, expires: response.expires})
                })
        },
        logout({ commit }) {
            removeToken()
            commit('SET_TOKEN', '', 0)
        },
        getUser({ commit }) {
            UserApi.info().then( response => {
                commit('SET_USERINFO', response.user)
                commit('SET_TOKEN', {token: response.token, expires: response.expires})
            })
        },
        refresh({ commit }) {
            UserApi.refresh().then( response => {
                commit('SET_TOKEN', {token: response.token, expires: response.expires})
            } )
        },
        updatePassword({ commit }, {oldPassword, newPassword}) {
            UserApi.updatePassword(oldPassword, newPassword)
                .then(() => {
                    commit('SET_PASSWORD_UPDATED')
                })
        }
    },
    mutations: {
        SET_TOKEN: (state, {token, expires}) => {
            state.token = token
            state.expires = (new Date()).getTime() + expires * 1000
            setToken(token, (new Date()).getTime() + expires * 1000)
        },
        SET_USERINFO: (state, userInfo) => {
            state.user = userInfo
        },
        SET_PASSWORD_UPDATED: (state) => {
            state.passwordUpdated = true
        },
    },
    getters: {
        user: state => state.user,
        token: state => state.token,
        expires: state => state.expires,
        passwordUpdated: state => state.passwordUpdated,
        userLogged: state => {
            return function() {
                return state.user && state.user.username
            }
        }
    }
}