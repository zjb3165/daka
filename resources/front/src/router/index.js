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