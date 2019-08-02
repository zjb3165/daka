import axios from 'axios'
import { MessageBox, Message } from 'element-ui'
import store from '../store'
import { getToken } from './auth'

const service = axios.create({
    baseURL: '/api/sys',
    timeout: 5000
})

service.interceptors.request.use(
    config => {
        if (store.getters.token) {
            config.headers['Authorization'] = 'Bearer ' + getToken()
        }
        return config
    },
    error => {
        console.log(error)
        return Promise.reject(error)
    },
)
service.interceptors.response.use(
    response => {
        const res = response.data
        if (res.code !== 0) {
            Message({
                message: res.message || 'Error',
                type: 'error',
                duration: 5000,
            })
            return Promise.reject(new Error(res.message || 'Error'))
        } else {
            return res
        }
    }
)

export default service