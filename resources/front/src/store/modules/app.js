import API from '../../api/index'
import { MORNING, MEMBER_INFO } from '../../utils/constants'
import storage from '../../utils/storage'

let m = storage.get(MEMBER_INFO)

export const app = {
    namespaced: true,
    state: {
        member: m || {},
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
            storage.set(MEMBER_INFO, member)
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