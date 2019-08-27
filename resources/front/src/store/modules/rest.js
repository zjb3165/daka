import moment from 'moment'

export const rest = {
    namespaced: true,
    state: {
        type: 'week',
        startDate: moment().startOf('isoWeek').format('MM月DD日'),
        endDate: moment().format('MM月DD日'),
        weekDay: moment().startOf('isoWeek').format('YYYY-MM-DD'),
        monthShow: '本月',
        month: moment().format('YYYY-MM'),
        showNext: false,
    },
    actions: {
        setType({ commit }, type) {
            commit('SET_TYPE', type)
            commit('SET_SHOW_NEXT', false)
            if (type === 'week') {
                commit('SET_DATE', {
                    startDate: moment().startOf('isoWeek').format('MM月DD日'),
                    endDate: moment().format('MM月DD日'),
                    weekDay: moment().startOf('isoWeek')
                })
            } else {
                commit('SET_MONTH', moment())
            }
        },
        goPrev({ commit, state }) {
            if (state.type === 'week') {
                let m = moment(state.weekDay).subtract(7, 'days')
                let wday = m.format('YYYY-MM-DD')
                commit('SET_DATE', {
                    startDate: m.format('MM月DD日'),
                    endDate: m.add(6, 'days').format('MM月DD日'),
                    weekDay: wday
                })
            } else {
                let m = moment(state.month).subtract(1, 'month')
                commit('SET_MONTH', m)
            }
        },
        goNext({ commit, state }) {
            if (state.type === 'week') {
                let m = moment(state.weekDay).add(7, 'days')
                let wday = m.format('YYYY-MM-DD')
                commit('SET_DATE', {
                    startDate: m.format('MM月DD日'),
                    endDate: m.add(6, 'days').format('MM月DD日'),
                    weekDay: wday
                })
            } else {
                let m = moment(state.month).add(1, 'month')
                commit('SET_MONTH', m)
            }
        }
    },
    mutations: {
        SET_TYPE: (state, type) => {
            state.type = type
        },
        SET_DATE: (state, { startDate, endDate, weekDay }) => {
            state.startDate = startDate
            state.endDate = endDate
            state.weekDay = weekDay
            if (weekDay === moment().startOf('isoWeek').format('YYYY-MM-DD')) {
                state.showNext = false
                state.endDate = moment().format('MM月DD日')
            } else {
                state.showNext = true
            }
        },
        SET_MONTH: (state, month) => {
            state.month = month.format('YYYY-MM')
            if (month.format('YYYY-MM') === moment().format('YYYY-MM')) {
                state.monthShow = '本月'
                state.showNext = false
            } else {
                state.monthShow = month.format('YYYY年MM月')
                state.showNext = true
            }
        },
        SET_SHOW_NEXT: (state, show) => {
            state.showNext = show
        }
    },
    getters: {
        type: state => state.type,
        startDate: state => state.startDate,
        endDate: state => state.endDate,
        month: state => state.monthShow,
        showNext: state => state.showNext,
    }
}