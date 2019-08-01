import Vue from 'vue';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'

import './icons/index'
import './styles/index.scss'

import router from './router'
import store from './store'

Vue.use(ElementUI)

new Vue({
    router,
    store
}).$mount('#app');