import request from '../utils/request'

export default {
    getList: () => {
        return request.get('/goal')
    },
    getDetail: (id) => {
        return request.get('/goal/' + id)
    },
    update: (id, datas) => {
        return request.post('/goal/' + id, datas)
    }
}