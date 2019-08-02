<template>
    <el-header class="header">
        <i class="el-icon-menu sidebarToggle" @click="handleCollapse"></i>
        <div class="float-right">
            <el-dropdown trigger="hover" class="header-action" @command="handleCommand">
                <span>{{ username }} <i class="el-icon-arrow-down el-icon--right"></i></span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item command="password">修改密码</el-dropdown-item>
                    <el-dropdown-item command="logout">退出</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
    </el-header>
</template>

<script>
export default {
    name: 'Headnav',
    computed: {
        username() {
            return this.$store.getters.user.name
        }
    },
    methods: {
        handleCollapse() {
            this.$store.dispatch('toggleSideBar')
        },
        handleCommand(command) {
            if (command === 'password') {
                this.$router.push({name: 'password'})
            } else if (command === 'logout') {
                console.log('logout')
            }
        }
    }
}
</script>
