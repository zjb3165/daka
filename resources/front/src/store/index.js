import Vue from 'vue'
import Vuex from 'vuex'

import { app } from './modules/app'
import { member } from './modules/member'
import { rest } from './modules/rest'
import { caution } from './modules/caution'
import { notice } from './modules/notice'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        app,
        member,
        rest,
        caution,
        notice,
    }
})

export default store