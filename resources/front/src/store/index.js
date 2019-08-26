import Vue from 'vue'
import Vuex from 'vuex'

import { app } from './modules/app'
import { member } from './modules/member'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        app,
        member,
    }
})

export default store