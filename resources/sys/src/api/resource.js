import request from '../utils/request'

export default {
    images: (tagid=0, page=1, pagesize=10) => {
        return request.get('/resource?tagid=' + tagid + '&page=' + page + '&pagesize=' + pagesize)
    },
    info: (id) => {
        return request.get('/resource/' + id)
    },
    delete: (id) => {
        return request.delete('/resource/' + id)
    }
}