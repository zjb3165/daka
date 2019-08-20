import Vue from 'vue';
import _ from 'lodash';

import router from './router'
import store from './store'

Vue.prototype._ = _
new View({
    router,
    store
}).$mount('#app');