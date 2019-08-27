import moment from 'moment'
import API from '../../api/index'

export const history = {
    namespaced: true,
    state: {
        date: moment().format('YYYY-MM-DD'),
        month: moment().format('YYYY-MM'),
        choosedDate: moment().format('YYYY-MM-DD'),
        list: [],
        loading: false,
    },
    actions: {
        getHistory({ commit, state }) {
            commit('SET_LOADING', true)
            API.getHistory('morning', state.month).then(res => {
                commit('SET_LIST', res.list)
                commit('SET_LOADING', false)
            }).catch(error => {
                commit('SET_LOADING', false)
                console.log(error)
            })
        },
        chooseDate({ commit }, date) {
            commit('SET_CHOOSED_DATE', date)
        },
        goPrev({ commit, state, dispatch }) {
            let month = moment(state.month + '-01')
            commit('SET_MONTH', month.subtract(1, 'month').format('YYYY-MM'))
            dispatch('getHistory')
        },
        goNext({ commit, state, dispatch }) {
            let month = moment(state.month + '-01')
            let date = moment(state.date)
            if (month.format('YYYY-MM') !== date.format('YYYY-MM')) {
                commit('SET_MONTH', month.add(1, 'month').format('YYYY-MM'))
                dispatch('getHistory')
            }
        }
    },
    mutations: {
        SET_LOADING: (state, status) => {
            state.loading = status
        },
        SET_CHOOSED_DATE: (state, date) => {
            state.choosedDate = date
        },
        SET_LIST: (state, list) => {
            state.list = [...state.list, ...list]
        },
        SET_MONTH: (state, month) => {
            state.month = month
        }
    },
    getters: {
        date: state => state.date,
        month: state => state.month,
        choosedDate: state => state.choosedDate,
        list: state => state.list,
    }
}