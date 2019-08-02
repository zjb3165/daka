import Vue from 'vue'
import Router from 'vue-router'
import Layout from '../layout/index'
import store from '../store'

Vue.use(Router);

const constantRoutes = [
    {
        path: '/login',
        name: 'login',
        component: () => import('../pages/login')
    },
    {
        path: '/',
        component: Layout,
        redirect: '/dashboard',
        meta: {title: '首页'},
        children: [
            {
                path: 'dashboard',
                name: 'dashboard',
                component: () => import('../pages/home'),
                meta: {title: '概览'}
            },
            {
                path: 'password',
                name: 'password',
                component: () => import('../pages/user/password'),
                meta: {title: '修改密码'}
            }
        ]
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
    
    function proceed() {
        if (to.path === '/login') {
            next({ path: '/' })
            NProgress.done()
        } else {
            next()
            NProgress.done()
        }
    }

    let token = getToken()
    let time = (new Date()).getTime()
    if (token && token.token && token.expires > time) {
        if (!store.getters.user || !store.getters.user.id) {
            store.dispatch('getUser')
        }
        if (token.expires - 600000 < time) {
            store.dispatch('refresh')
        }
        proceed()
    } else if (whiteList.indexOf(to.path) !== -1) {
        next()
    } else {
        next(`/login?redirect=${to.path}`)
    }
})

router.afterEach(() => {
    NProgress.done()
})

export default router