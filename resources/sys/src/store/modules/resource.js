import ResourceApi from '../../api/resource'

export const resource = {
    namespaced: true,
    state: {
        list: [],
        tags: [],
        info: {},
        page: 1,
        pagesize: 10,
        count: 0,
        pages: 0,
    },
    actions: {
        getImages({ commit, state }, { tagid, page }) {
            commit('SET_PAGE', page)
            return new Promise((resolve, reject) => {
                ResourceApi.images(tagid, page, state.pagesize).then(response => {
                    commit('SET_LIST', {
                        list: response.list,
                        count: response.count,
                        pages: response.pages,
                    })
                    resolve()
                }).catch(error => {
                    reject(error)
                })
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
        SET_LIST: (state, data) => {
            state.list = data.list
            state.count = data.count
            state.pages = data.pages
        },
        ADD_RESOURCE: (state, resource) {
            state.list = [resource, ...state.list]
        },
        REMOVE_RESOURCE: (state, id) {
            state.list = _.filter(state.list, (item) => {
                return item.id !== id
            })
        },
        SET_TAGS: (state, tags) => {
            state.tags = tags
        },
        SET_INFO: (state, info) => {
            state.info = info
        },
        SET_PAGE: (state, page) => {
            state.page = page
        },
        SET_PAGESIZE: (state, pagesize) => {
            state.pagesize = pagesize
        }
    },
    getters: {
        list: state => state.list,
        tags: state => state.tags,
        info: state => state.info,
        page: state => state.page,
        pagesize: state => state.pagesize,
    }
}