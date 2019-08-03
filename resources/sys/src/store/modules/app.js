const state = {
    sidebar: {
        opened: true,
        menus: [
            {
                menuId: 1,
                title: '首页',
                menuCode: 'dashboard',
                link: '/dashboard',
                icon: 'el-icon-menu',
                children: [],
            },
            {
                menuId: 2,
                title: '系统设置',
                menuCode: 'system',
                link: '/system',
                icon: 'el-icon-menu',
                children: [
                    {
                        menuId: 3,
                        title: '系统管理员',
                        menuCode: 'admin',
                        link: '/system/admin',
                        icon: 'el-icon-menu',
                    },
                    {
                        menuId: 4,
                        title: '微信设置',
                        menuCode: 'weixin',
                        link: '/system/weixin',
                        icon: 'el-icon-menu'
                    }
                ]
            }
        ],
        withoutAnimation: false,
    },
    device: 'desktop'
}

const mutations = {
    TOGGLE_SIDEBAR: state => {
        state.sidebar.opened = ! state.sidebar.opened
        state.sidebar.withoutAnimation = false
    },
    CLOSE_SIDEBAR: (state, withoutAnimation) => {
        state.sidebar.opened = false
        state.sidebar.withoutAnimation = withoutAnimation
    },
    TOGGLE_DEVICE: (state, device) => {
        state.device = device
    }
}

const actions = {
    toggleSideBar({ commit }) {
        commit('TOGGLE_SIDEBAR')
    },
    closeSideBar({ commit }, { withoutAnimation }) {
        commit('CLOSE_SIDEBAR', withoutAnimation)
    },
    toggleDevice({ commit }, device) {
        commit('TOGGLE_DEVICE', device)
    }
}

const getters = {
    sidebar: state => state.sidebar,
    device: state => state.device,
}

export default {
    state,
    mutations,
    actions,
    getters,
}