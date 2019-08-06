import ResourceApi from '../../api/resource'

export const resource = {
    namespaced: true,
    state: {
        opener: '',             //打开对话框用户
        showDialog: false,      //显示选择对话框
        listLoading: false,     //是否在加载列表
        multiCheck: false,      //是否可选择多个
        list: [],               //列表数据
        tags: [],               //标签列表
        checkedList: [],        //选中的资源文件
        info: {},               //
        tagid: 0,               //当前选中标签id
        page: 1,                //当前页数
        pagesize: 12,           //每页数量
        count: 0,               //总资源数量
        pages: 0,               //总页数
        uploadAction: '/api/sys/resource/upload',
    },
    actions: {
        toggleDialog({ commit, state, dispatch }, options={}) {
            if (! state.showDialog) {
                dispatch('getImages', 0, 1)
            }
            commit('TOGGLE_DIALOG_SHOW')
            commit('SET_OPENER', options.opener || '')
            commit('SET_MULTI_CHECK', options.multiCheck || false)
            commit('CLEAR_CHECKED')
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
        },
        toggleCheck({ commit }, id) {
            commit('SET_CHECKED', id)
        },
        setMultiCheck({ commit }, status) {
            commit('SET_MULTI_CHECK', status)
        }
    },
    mutations: {
        TOGGLE_DIALOG_SHOW: (state) => {
            state.showDialog = !state.showDialog
        },
        SET_OPENER: (state, opener) => {
            state.opener = opener
        },
        SET_LIST: (state, data) => {
            state.list = _.map(data.list, (item) => {
                item.checked = false
                if (_.findIndex(state.checkedList, {id: item.id}) !== -1) {
                    item.checked = true
                }
                return item
            })
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
        SET_CHECKED: (state, id) => {
            let checkedItem = null
            state.list = _.map(state.list, (item) => {
                if (item.id === id) {
                    item.checked = ! item.checked
                    if (item.checked) {
                        checkedItem = item
                    }
                } else if (! state.multiCheck) {
                    item.checked = false
                }
                return item
            })
            if (state.multiCheck) {   //多选
                if (checkedItem) {
                    state.checkedList = [...state.checkedList, checkedItem]
                } else {
                    state.checkedList = _.filter(state.checkedList, (item) => {
                        return item.id !== id
                    })
                }
            } else {    //单选
                state.checkedList = [checkedItem]
            }
        },
        CLEAR_CHECKED: (state) => {
            state.checkedList = []
            state.list = _.map(state.list, (item) => {
                item.checked = false
                return item
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
        },
        SET_MULTI_CHECK: (state, status) => {
            state.multiCheck = status
        }
    },
    getters: {
        opener: state => state.opener,
        showDialog: state => state.showDialog,
        listLoading: state => state.listLoading,
        list: state => state.list,
        tags: state => state.tags,
        checkedList: state => state.checkedList,
        page: state => state.page,
        count: state => state.count,
        pagesize: state => state.pagesize,
        uploadAction: state => state.uploadAction,
    }
}