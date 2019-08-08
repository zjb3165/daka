import request from '../utils/request'
import {toQueryString} from '../utils/util'

export default {
    getList: (parent_id = 0, nickname = '', orderby = '', page = 1, pagesize = 10) => {
        let params = {
            parent_id: parent_id,
            nickname: nickname,
            orderby: orderby,
            page: page,
            pagesize: pagesize,
        }
        return request.get('/member?' + toQueryString(params));
    },
    getDetail: (id) => {
        return request.get('/member/' + id)
    },
    update: (id, datas) => {
        return request.post('/member/' + id, datas)
    }
}