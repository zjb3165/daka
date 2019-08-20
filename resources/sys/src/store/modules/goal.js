import GoalApi from '../../api/goal'
import _ from 'lodash'

export const goal = {
    namespaced: true,
    state: {
        listLoading: false,
        list: [],
        detailLoading: false,
        goal: {
            id: 0,
            title: '',
            start_time: 0,
            end_time: 0,
            credits: 0,
            reply: '',
            checked_reply: '',
            not_in_time_reply: '',
            repeat: false,
        },
        updating: false,
    },
    actions: {
        getList({ commit }) {
            commit('SET_LIST_LOADING', true)
            GoalApi.getList().then(response => {
                commit('SET_LIST', response.list)
                commit('SET_LIST_LOADING', false)
            })
        },
        getDetail({ commit }, id) {
            commit('SET_DETAIL_LOADING', true)
            GoalApi.getDetail(id).then(response => {
                commit('SET_DETAIL', response.goal)
                commit('SET_DETAIL_LOADING', false)
            })
        },
        update({ commit }, goal) {
            commit('SET_UPDATING', true)
            GoalApi.update(goal.id, goal).then(response => {
                commit('SET_DETAIL', response.goal)
                commit('SET_UPDATING', false)
            })
        }
    },
    mutations: {
        SET_LIST: (state, list) => {
            state.list = list
        },
        SET_LIST_LOADING: (state, status) => {
            state.listLoading = status
        },
        SET_DETAIL: (state, goal) => {
            state.goal = goal
            state.list = _.map(state.list, item => {
                if (item.id === goal.id) {
                    return {...item, goal}
                } else {
                    return item
                }
            })
        },
        SET_DETAIL_LOADING: (state, status) => {
            state.detailLoading = status
        },
        SET_UPDATING: (state, status) => {
            state.updating = status
        }
    },
    getters: {
        list: state => state.list,
        listLoading: state => state.listLoading,
        goal: state => state.goal,
        detailLoading: state => state.detailLoading,
        updating: state => state.updating,
    }
}