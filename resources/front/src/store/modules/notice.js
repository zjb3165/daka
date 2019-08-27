import Vue from 'vue'

let vue = new Vue()

export const notice = {
    namespaced: true,
    state: {
        friends: [
            {
                id: 1,
                nickname: 'jumper',
                avatar: 'http://thirdwx.qlogo.cn/mmopen/PiajxSqBRaEIQZxJy1t1jrhJQNEVrFYVC8mhAbrSr8TxDkZibDo7Ph1oMoTKISQcMa27MOWckXAY5fphqIkTicLNg/132',
                morning: false,
                evening: false,
            },
            {
                id: 2,
                nickname: 'zhezhe',
                avatar: 'http://thirdwx.qlogo.cn/mmopen/PiajxSqBRaEIQZxJy1t1jrhJQNEVrFYVC8mhAbrSr8TxDkZibDo7Ph1oMoTKISQcMa27MOWckXAY5fphqIkTicLNg/132',
                morning: true,
                evening: false,
            },
            {
                id: 3,
                nickname: 'taotao',
                avatar: 'http://thirdwx.qlogo.cn/mmopen/PiajxSqBRaEIQZxJy1t1jrhJQNEVrFYVC8mhAbrSr8TxDkZibDo7Ph1oMoTKISQcMa27MOWckXAY5fphqIkTicLNg/132',
                morning: true,
                evening: true,
            }
        ],
        first: {
            morning: false,
            evening: false,
        }
    },
    actions: {
        setFirstNotice({ commit }, {code, status}) {
            commit('SET_FIRST_STATUS', {
                code: code,
                status: status
            })
        },
        setFriendNotice({ commit }, {id, code, status}) {
            commit('SET_FRIENDS_NOTICE', {
                id: id,
                code: code,
                status: status
            })
        }
    },
    mutations: {
        SET_FIRST_STATUS: (state, {code, status}) => {
            state.first[code] = status
        },
        SET_FRIENDS_NOTICE: (state, {id, code, status}) => {
            vue._.forEach(state.friends, friend => {
                if (friend.id === id) {
                    friend[code] = status
                }
            })
        },
    },
    getters: {
        friends: state => state.friends,
        first: state => state.first,
    }
}