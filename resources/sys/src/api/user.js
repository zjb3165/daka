import request from '../utils/request'

export default {
    login: function(username, password) {
        return request.post('/auth/login', {
            username: username,
            password: password
        })
    },
    refresh: function() {
        return request.get('/refresh')
    },
    updatePassword: function(old_pwd, new_pwd) {
        return request.post('/auth/password', {
            old_password: old_pwd,
            new_password: new_pwd
        })
    },
    logout: function() {
        return request.get('/auth/logout')
    },
    info: function() {
        return request.get('/auth/info')
    }
}