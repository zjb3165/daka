import UserApi from '../../api/user'
import { getToken, setToken, removeToken } from '../../utils/auth'

let token = getToken()

export const users = {
    state: {
        user: {},
        token: token.token || '',
        expires: token.expires,
    },
    actions: {
        login({ commit }, userInfo) {
            const { username, password } = userInfo
            return new Promise((resolve, reject) => {
                UserApi.login(username, password)
                .then(function(response){
                    commit('SET_USERINFO', response.user)
                    resolve()
                }).catch(error => {
                    reject(error)
                })
            })
        },
        logout({ commit }) {
            removeToken()
            commit('SET_TOKEN', {token: '', expires: 0})
            commit('SET_USERINFO', {})
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
            })
        },
        updatePassword({ commit }, {oldPassword, newPassword}) {
            return new Promise((resolve, reject) => {
                UserApi.updatePassword(oldPassword, newPassword)
                .then(() => {
                    resolve()
                }).catch(error => {
                    reject(error)
                })
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
    },
    getters: {
        user: state => state.user,
        token: state => state.token,
        expires: state => state.expires,
        userLogged: state => {
            return function() {
                return state.user && state.user.username
            }
        }
    }
}