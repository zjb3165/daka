import UserApi from '../../api/user'
import { setToken, removeToken } from '../../utils/auth'

export const users = {
    state: {
        user: {},
        token: '',
    },
    actions: {
        login({ commit }, userInfo) {
            const { username, password } = userInfo
            UserApi.login(username, password)
                .then(function(response){
                    console.log(response)
                    commit('SET_USERINFO', response.user)
                    commit('SET_TOKEN', response.token)
                    setToken(response.token)
                })
        },
        logout({ commit }) {
            removeToken()
            commit('SET_TOKEN', '')
        }
    },
    mutations: {
        SET_TOKEN: (state, token) => {
            state.token = token
        },
        SET_USERINFO: (state, userInfo) => {
            state.user = userInfo
        }
    },
    getters: {
        user: state => state.user,
        token: state => state.token,
    }
}