import Vue from 'vue'
import API from '../../api'
import { MORNING } from '../../utils/constants'

let vue = new Vue()

export const member = {
    namespaced: true,
    state: {
        stat: {},
        type: MORNING,
        histories: [],
        ranks: [],
        myRank: {},
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
        getRanks({ commit, rootGetters }, code) {
            commit('SET_LOADING', true)
            commit('SET_TYPE', code)
            API.getRanks(code).then(res => {
                commit('SET_RANKS', res.ranks)
                commit('SET_LOADING', false)
                let member = rootGetters['app/member']
                if (member) {
                    commit('SET_MY_RANK', member.id)
                }
            }).catch(error => {
                commit('SET_LOADING', false)
                console.log(error)
            })
        },
        getMyRank({ commit }, id) {
            commit('SET_MY_RANK', id)
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
        SET_MY_RANK: (state, id) => {
            vue._.forEach(state.ranks, (item, index) => {
                if (item.id === id) {
                    item.index = index + 1
                    state.myRank = {...state.myRank, ...item}
                }
            })
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
        myRank: state => state.myRank,
        loading: state => state.loading,
    }
}