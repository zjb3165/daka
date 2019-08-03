import request from '../utils/request'

export default {
    getList: () => {
        return request.get('/admin')
    },
    getInfo: (id) => {
        return request.get('/admin/' + id)
    },
    create: (username, name, password) => {
        return request.post('/admin', {
            username: username,
            name: name,
            password: password
        })
    },
    update: (id, name, password) => {
        let data = {
            name: name,
        }
        if (password !== '') {
            data['password'] = password
        }
        return request.post('/admin/' + id, data)
    },
    delete: (id) => {
        return request.delete('/admin/' + id)
    },
    check: (username) => {
        return request.post('/admin/check', {username: username})
    }
} 