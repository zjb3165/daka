import axios from 'axios'
import { MessageBox, Message } from 'element-ui'
import store from '../store'
import router from '../router'

const service = axios.create({
    baseURL: '/api/sys',
    timeout: 5000
})

service.interceptors.request.use(
    config => {
        if (store.getters.token) {
            config.headers['Authorization'] = 'Bearer ' + store.getters.token
        }
        return config
    },
    error => {
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
            if (res.code === 40002) {
                MessageBox.alert('访问失败，请刷新重试', '', {
                    confirmButtonText: '确定',
                    callback: () => {
                        router.push('/login?redirect=' + router.currentRoute.path)
                    }
                })
            } else {
                
                return Promise.reject(new Error(res.message || 'Error'))
            }
        } else {
            return res
        }
    }
)

export default service