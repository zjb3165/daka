import MemberApi from '../../api/member'
import _ from 'lodash'

export const member = {
    namespaced:true,
    state: {
        list: [],
        listLoading: false,
        member: {},
        detailLoading: false,
        updating: false,
        filters: {},
        page: 1,
        pagesize: 10,
        counts: 0,
        showEdit: false,
    },
    actions: {
        getList({ commit }, payloads={}) {
            commit('SET_LIST_LOADING', true)
            commit('SET_PAGE', payloads.page || 1)
            commit('SET_PAGESIZE', payloads.pagesize || 10)
            commit('SET_FILTERS', payloads)
            MemberApi.getList(payloads.parent_id || 0, payloads.nickname || '', payloads.orderby || '', payloads.page || 1, payloads.pagesize || 10)
                .then(response => {
                    commit('SET_LIST', response)
                    commit('SET_LIST_LOADING', false)
                }).catch(error => {
                    commit('SET_LIST_LOADING', false)
                    console.log(error)
                })
        },
        changePage({ commit, state, dispatch }, page) {
            commit('SET_PAGE', page)
            let filters = {...state.filters, page}
            dispatch('getList', filters)
        },
        getDetail({ commit }, id) {
            commit('SET_DETAIL_LOADING', true)
            MemberApi.getDetail(id).then(response => {
                commit('SET_MEMBER', response.member)
                commit('SET_DETAIL_LOADING', false)
            }).catch(error => {
                commit('SET_DETAIL_LOADING', false)
                console.log(error)
            })
        },
        update({ commit }, payloads) {
            commit('SET_UPDATING', true)
            MemberApi.update(payloads.id, payloads).then(response => {
                commit('SET_MEMBER', response.member)
                commit('SET_UPDATING', false)
            }).catch(error => {
                commit('SET_UPDATING', false)
                console.log(error)
            })
        },
        toggleEditDialog({ commit, state }, status = undefined) {
            commit('SET_SHOW_EDIT', ! _.isUndefined(status) ? status : !state.showEdit)
        }
    },
    mutations: {
        SET_PAGE: (state, page) => {
            state.page = page
        },
        SET_PAGESIZE: (state, pagesize) => {
            state.pagesize = pagesize
        },
        SET_FILTERS: (state, filters) => {
            state.filters = {...state.filters, ...filters}
        },
        SET_LIST: (state, payloads) => {
            state.list = payloads.list
            state.counts = payloads.count
        },
        SET_LIST_LOADING: (state, status) => {
            state.listLoading = status
        },
        SET_MEMBER: (state, member) => {
            state.member = member
            state.list = _.map(state.list, (m) => {
                if (m.id === member.id) {
                    return {...m, ...member}
                } else {
                    return m
                }
            })
        },
        SET_DETAIL_LOADING: (state, status) => {
            state.detailLoading = status
        },
        SET_UPDATING: (state, status) => {
            state.updating = status
        },
        SET_SHOW_EDIT: (state, status) => {
            state.showEdit = status
        }
    },
    getters: {
        list: state => state.list,
        listLoading: state => state.listLoading,
        member: state => state.member,
        detailLoading: state => state.detailLoading,
        updating: state => state.updating,
        counts: state => state.counts,
        pagesize: state => state.pagesize,
        showDialog: state => state.showEdit
    }
}