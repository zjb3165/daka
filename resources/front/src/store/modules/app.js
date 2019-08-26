import API from '../../api/index'

export const app = {
    namespaced: true,
    state: {
        member: {},
    },
    actions: {
        getMember({ commit }) {
            API.getMember().then(res => {
                commit('SET_MEMBER', res.member)
            })
        }
    },
    mutations: {
        SET_MEMBER: (state, member) => {
            state.member = {...state.member, ...member}
        }
    },
    getters: {
        member: state => state.member
    }
}