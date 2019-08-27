import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import Layout from '../layout/index'

const constantRoutes = [
    {
        path: '/',
        component: Layout,
        children: [
            {
                path: '/',
                name: 'home',
                component: () => import('../pages/home/index'),
                meta: {title: 'home'}
            },
            {
                path: 'ranks',
                name: 'ranks',
                component: () => import('../pages/home/ranks'),
                meta: {title: 'ranks'}
            },
            {
                path: 'rest',
                name: 'rest',
                component: () => import('../pages/home/rest'),
                meta: {title: 'rest'}
            },
            {
                path: 'caution',
                name: 'caution',
                component: () => import('../pages/feature/caution'),
                meta: {title: 'caution'}
            },
            {
                path: 'notice',
                name: 'notice',
                component: () => import('../pages/feature/notice'),
                meta: {title: 'notice'}
            },
            {
                path: 'history',
                name: 'history',
                component: () => import('../pages/feature/history'),
                meta: {title: 'history'}
            }
        ]
    }
]

const createRouter = () => new Router({
    scrollBehavior: () => ({y: 0}),
    routes: constantRoutes
})

const router = createRouter()

export default router