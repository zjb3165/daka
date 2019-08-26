import axios from 'axios'

const service = axios.create({
    baseURL: '/api/front',
    timeout: 5000
})

service.interceptors.response.use(
    response => {
        const res = response.data
        if (res.code !== 0) {
            console.log(res)
        }
        return res
    }
)

export default service