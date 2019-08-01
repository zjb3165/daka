import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);

const constantRoutes = [
    {
        path: '/login',
        name: 'login',
        component: () => import('../pages/login')
    },
    {
        path: '/',
        component: () => import('../pages/home')
    }
]

const createRouter = () => new Router({
    scrollBehavior: () => ({y: 0}),
    routes: constantRoutes
})

const router = createRouter()

import { getToken } from '../utils/auth'
import NProgress from 'nprogress'

const whiteList = ['/login']

router.beforeEach(async(to, from, next) => {
    NProgress.start()
    
    const hasToken = getToken()
    if (hasToken) {
        if (to.path === '/login') {
            next({ path: '/' })
            NProgress.done()
        } else {
            next()
            NProgress.done()
        }
    } else {
        if (whiteList.indexOf(to.path) !== -1) {
            next()
        } else {
            next(`/login?redirect=${to.path}`)
            NProgress.done()
        }
    }
})

router.afterEach(() => {
    NProgress.done()
})

export default router