import Vue from 'vue'
import Router from 'vue-router'
import store from '../store'

Vue.use(Router)

const constantRoutes = [

]

const createRouter = () => new Router({
    scrollBehavior: () => ({y: 0}),
    routes: constantRoutes
})

const router = createRouter

export default router