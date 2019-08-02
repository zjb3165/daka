<template>
    <el-aside class="sidebar" v-bind:class="{'sidebar-collapse':!isCollapse}">
        <el-header class="logo">
            <h1>{{ title }}</h1>
        </el-header>
        <el-menu :router="true" :default-active="$route.path" :collapse="!isCollapse">
            <el-menu-item v-for="menu in menus" :key="menu.menuId" :index="menu.link" v-if="menu.children.length === 0">
                <i :class="menu.icon"></i>
                <span slot="title">{{ menu.title }}</span>
            </el-menu-item>
            <el-submenu :index="menu.link" v-else>
                <template slot="title">
                    <i :class="menu.icon" />
                    <span slot="title">{{ menu.title }}</span>
                </template> 
                <el-menu-item :index="child.link" v-for="child in menu.children" :key="child.menuId">
                    <i :class="menu.icon"></i>
                    <span slot="title">{{ child.title }}</span>
                </el-menu-item>
            </el-submenu>
        </el-menu>
    </el-aside>
</template>

<script>
export default {
    name:'Sidebar',
    computed: {
        isCollapse() {
            return this.$store.state.app.sidebar.opened
        },
        menus() {
            return this.$store.state.app.sidebar.menus
        },
        title() {
            return this.$store.state.settings.title
        }
    }
}
</script>
