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
                        menuId: 201,
                        title: '系统用户管理',
                        menuCode: 'system-admin',
                        link: '/system/admin',
                        icon: 'el-icon-menu',
                    },
                    {
                        menuId: 202,
                        title: '微信设置',
                        menuCode: 'system-weixin',
                        link: '/system/setting',
                        icon: 'el-icon-menu'
                    }
                ]
            },
            {
                menuId: 3,
                title: '打卡管理',
                menuCode: 'goal',
                link: '/goal',
                icon: 'el-icon-menu',
                children: [
                    {
                        menuId: 301,
                        title: '打卡管理',
                        menuCode: 'goal-goal',
                        link: '/goal',
                        icon: 'el-icon-menu'
                    }
                ]
            },
            {
                menuId: 4,
                title: '会员管理',
                menuCode: 'member',
                link: '/member',
                icon: 'el-icon-menu',
                children: [
                    {
                        menuId: 401,
                        title: '会员管理',
                        menuCode: 'member-member',
                        link: '/member',
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