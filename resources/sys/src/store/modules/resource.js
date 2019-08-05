import ResourceApi from '../../api/resource'

export const resource = {
    namespaced: true,
    state: {
        showDialog: false,
        listLoading: false,
        list: [],
        tags: [],
        info: {},
        tagid: 0,
        page: 1,
        pagesize: 12,
        count: 0,
        pages: 0,
    },
    actions: {
        toggleDialog({ commit }) {
            commit('TOGGLE_DIALOG_SHOW')
        },
        getImages({ commit, state }, { tagid, page }) {
            commit('SET_PAGE', page)
            commit('SET_TAGID', tagid)
            commit('SET_LIST_LOADING', true)
            ResourceApi.images(tagid, page, state.pagesize).then(response => {
                commit('SET_LIST', {
                    list: response.list,
                    count: response.count,
                    pages: response.pages,
                })
                commit('SET_LIST_LOADING', false)
            })
        },
        pageChange({ commit, state, dispatch }, page) {
            commit('SET_PAGE', page)
            return dispatch('getImages', {
                tagid: state.tagid,
                page: page
            })
        },
        appendResource({ commit }, info) {
            commit('ADD_RESOURCE', info)
        },
        removeResource({ commit }, id) {
            return new Promise((resolve) => {
                ResourceApi.delete(id).then(() => {
                    commit('REMOVE_RESOURCE', id)
                    resolve()
                })
            })
        }
    },
    mutations: {
        TOGGLE_DIALOG_SHOW: (state) => {
            state.showDialog = !state.showDialog
        },
        SET_LIST: (state, data) => {
            state.list = data.list
            state.count = data.count
            state.pages = data.pages
        },
        ADD_RESOURCE: (state, resource) => {
            state.list = [resource, ...state.list]
        },
        REMOVE_RESOURCE: (state, id) => {
            state.list = _.filter(state.list, (item) => {
                return item.id !== id
            })
        },
        SET_TAGS: (state, tags) => {
            state.tags = tags
        },
        SET_TAGID: (state, tagid) => {
            state.tagid = tagid
        },
        SET_INFO: (state, info) => {
            state.info = info
        },
        SET_PAGE: (state, page) => {
            state.page = page
        },
        SET_LIST_LOADING: (state, status) => {
            state.listLoading = status
        },
        SET_PAGESIZE: (state, pagesize) => {
            state.pagesize = pagesize
        }
    },
    getters: {
        showDialog: state => state.showDialog,
        listLoading: state => state.listLoading,
        list: state => state.list,
        tags: state => state.tags,
        info: state => state.info,
        page: state => state.page,
        count: state => state.count,
        pagesize: state => state.pagesize,
    }
}