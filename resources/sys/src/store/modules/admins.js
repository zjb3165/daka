import AdminApi from '../../api/admin'
import _ from 'lodash'

export const admins = {
    namespaced: true,
    state: {
        list: [],
        user: {},
        usernameExists: false,
    },
    actions: {
        getList({ commit }) {
            return new Promise((resolve) => {
                AdminApi.getList().then(response => {
                    commit('SET_LIST', response.list)
                    resolve()
                })
            })
        },
        add({ commit }, { username, name, password }) {
            return new Promise((resolve, reject) => {
                AdminApi.create(username, name, password).then(response => {
                    commit('APPEND_USER', response.user)
                    resolve()
                }).catch(error => {
                    reject(error)
                })
            })
        },
        update({ commit }, {id, name, password}) {
            return new Promise((resolve, reject) => {
                AdminApi.update(id, name, password).then(response => {
                    commit('UPDATE_USER', response.user)
                    resolve()
                }).catch(error => {
                    reject(error)
                })
            })
        },
        get({ commit, state }, id) {
            return new Promise((resolve, reject) => {
                let idx = _.findIndex(state.list, {id: id})
                if (state.list[idx]) {
                    commit('SET_USER', state.list[idx])
                    resolve()
                } else {
                    reject()
                }
            })
        },
        check({ commit }, username) {
            commit('SET_USERNAME_EXISTS', false)
            return new Promise((resolve, reject) => {
                AdminApi.check(username).then(response => {
                    commit('SET_USERNAME_EXISTS', response.exists)
                    resolve()
                }).catch(error => {
                    reject(error)
                })
            })
        },
        delete({ commit }, id) {
            return new Promise((resolve, reject) => {
                AdminApi.delete(id).then(() => {
                    commit('DELETE_USER', id)
                    resolve()
                }).catch(error => {
                    reject(error)
                })
            })
        }
    },
    mutations: {
        SET_LIST:(state, list) => {
            state.list = list
        },
        APPEND_USER: (state, user) => {
            state.list = [...state.list, user]
        },
        UPDATE_USER: (state, user) => {
            state.list = _.map(state.list, (item) => {
                return item.id === user.id ? user : item
            })
            state.user = user
        },
        SET_USERNAME_EXISTS: (state, status) => {
            state.usernameExists = status
        },
        SET_USER: (state, user) => {
            state.user = user
        },
        DELETE_USER: (state, id) => {
            state.list = _.filter(state.list, (item) => {
                return item.id !== id
            })
        }
    },
    getters: {
        list: state => state.list,
        user: state => state.user,
        usernameExists: state => state.usernameExists,
    }
}