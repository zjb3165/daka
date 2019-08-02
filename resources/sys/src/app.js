import Vue from 'vue';
import ElementUI from 'element-ui'
import _ from 'lodash'
import 'element-ui/lib/theme-chalk/index.css'

import './styles/app.scss'

import router from './router'
import store from './store'

Vue.use(ElementUI)
Vue.prototype._ = _

new Vue({
    router,
    store
}).$mount('#app');