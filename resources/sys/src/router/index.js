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
                path: '/dashboard',
                name: 'dashboard',
                component: () => import('../pages/home'),
                meta: {title: '概览'}
            },
            {
                path: '/password',
                name: 'password',
                component: () => import('../pages/user/password'),
                meta: {title: '修改密码'}
            },
            {
                path: '/member',
                name: 'member',
                component: () => import('../pages/member/index'),
                meta: {title: '会员管理'},
            }
        ]
    },
    {
        path: '/system',
        component: Layout,
        redirect: '/system/admin',
        meta: {title: '系统管理'},
        children: [
            {
                path: 'admin',
                name: 'admin',
                component: () => import('../pages/admin/index'),
                meta: {title: '系统用户管理'}
            },
            {
                path: 'setting',
                name: 'setting',
                component: () => import('../pages/system/setting'),
                meta: {title: '微信公众号设置'}
            }
        ]
    },
    {
        path: '/goal',
        component:Layout,
        meta: {title: '打卡目标管理'},
        children: [
            {
                path: '/',
                name: 'goal',
                component: () => import('../pages/goal'),
                meta: {title: '打卡目标管理'},
            }
        ]
    },
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
            setTimeout(() => {
                store.dispatch('getUser')
            }, 1000)
        }
        //toke还有10分钟过期时刷新token
        if (token.expires - 600000 < time) {
            setTimeout(() => {
                store.dispatch('refresh')
            }, 1000)
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