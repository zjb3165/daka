export const users = {
    state: {
        user: {},
        token: '',
    },
    action: {
        login({ commit }, userInfo) {
            const { username, password } = userInfo
            commit('SET_TOKEN', 'adfasdfasdf')
            commit('SET_USERINFO', {username:'afdafd', name: '管理员'})
        },
        getInfo({ commit, state }) {

        },
        logout({ commit, state }) {

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