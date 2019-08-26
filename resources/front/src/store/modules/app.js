import API from '../../api/index'
import { MORNING } from '../../utils/constants'

export const app = {
    namespaced: true,
    state: {
        member: {},
        style: MORNING,
    },
    actions: {
        getMember({ commit }) {
            API.getMember().then(res => {
                commit('SET_MEMBER', res.member)
            })
        },
        setStyle({ commit }, style) {
            commit('SET_STYLE', style)
        }
    },
    mutations: {
        SET_MEMBER: (state, member) => {
            state.member = {...state.member, ...member}
        },
        SET_STYLE: (state, style) => {
            state.style = style
        }
    },
    getters: {
        member: state => state.member,
        style: state => state.style,
    }
}