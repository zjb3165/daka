import API from '../../api'
import { MORNING } from '../../utils/constants'

export const member = {
    namespaced: true,
    state: {
        stat: {},
        type: MORNING,
        histories: [],
        ranks: [],
        loading: false,
    },
    actions: {
        getStat({ commit }, code) {
            commit('SET_LOADING', true)
            commit('SET_TYPE', code)
            API.getToday(code).then(res => {
                commit('SET_STAT', res.stat)
                commit('SET_LOADING', false)
            }).catch(error => {
                commit('SET_LOADING', false)
                console.log(error)
            })
        },
        getHistories({ commit }, code, month) {
            commit('SET_LOADING', true)
            commit('SET_TYPE', code)
            API.getHistory(code, month).then(res => {
                commit('SET_HISTORIES', res.list)
                commit('SET_LOADING', false)
            }).catch(error => {
                commit('SET_LOADING', false)
                console.log(error)
            })
        },
        getRanks({ commit }, code) {
            commit('SET_LOADING', true)
            commit('SET_TYPE', code)
            API.getRanks(code).then(res => {
                commit('SET_RANKS', res.ranks)
                commit('SET_LOADING', false)
            }).catch(error => {
                commit('SET_LOADING', false)
                console.log(error)
            })
        }
    },
    mutations: {
        SET_TYPE: (state, type) => {
            state.type = type
        },
        SET_STAT: (state, data) => {
            state.stat = {...state.stat, ...data}
        },
        SET_HISTORIES: (state, list) => {
            state.histories = [...state.histories, ...list]
        },
        SET_RANKS: (state, list) => {
            state.ranks = list
        },
        SET_LOADING: (state, status) => {
            state.loading = status
        },
    },
    getters: {
        type: state => state.type,
        stat: state => state.stat,
        histories: state => state.histories,
        ranks: state => state.ranks,
        loading: state => state.loading,
    }
}