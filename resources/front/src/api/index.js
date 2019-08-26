import request from '../utils/request'

export default {
    getMember: () => {
        return request.get('/member')
    },
    getHistory: (code, month) => {
        return request.get('/member/history?code=' + code + '&month=' + month)
    },
    getToday: (code) => {
        return request.get('/member/today?code=' + code)
    },
    getRanks: (code) => {
        return request.get('/member/ranks?code=' + code)
    }
}