import Vue from 'vue'
import Vuex from 'vuex'

import { app } from './modules/app'
import { member } from './modules/member'
import { rest } from './modules/rest'
import { caution } from './modules/caution'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        app,
        member,
        rest,
        caution,
    }
})

export default store