import request from '../utils/request'

export default {
    login: function(username, password) {
        return request.post('/login', {
            username: username,
            password: password
        })
    },
    refresh: function() {
        return request.get('/refresh')
    },
    updatePassword: function(old_pwd, new_pwd) {
        return request.post('/password', {
            old_password: old_pwd,
            new_password: new_pwd
        })
    },
    logout: function() {
        return request.get('/logout')
    }
}