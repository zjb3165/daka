import Vue from 'vue'
import Vuex from 'vuex'
import { users } from './modules/user'
import { settings } from './modules/settings'
import { admins } from './modules/admins'
import { resource } from './modules/resource'
import app from './modules/app'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        app,
        settings,
        users,
        admins,
        resource,
    }
})

export default store