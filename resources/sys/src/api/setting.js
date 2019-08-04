import request from '../utils/request'

export default {
    get: (code) => {
        return request.get('/setting?code=' + code)
    },
    save: (code, params) => {
        return request.post('/setting', {
            code: code,
            params: params,
        })
    }
}