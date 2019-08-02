import Vue from 'vue'
import Vuex from 'vuex'
import { users } from './modules/user'
import { settings } from './modules/settings'
import app from './modules/app'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        app,
        settings,
        users,
    }
})

export default store