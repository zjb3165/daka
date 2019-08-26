import Vue from 'vue';
import _ from 'lodash';

import router from './router'
import store from './store'

import './utils/rem'
import './styles/app.scss'

Vue.prototype._ = _
new Vue({
    router,
    store
}).$mount('#app');