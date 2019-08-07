<template>
    <el-container style="height:100%;">
        <sidebar />
        <el-container direction="vertical">
            <headnav />
            <el-main>
                <el-breadcrumb separator-class="el-icon-arrow-right" class="breadcrumb">
                    <el-breadcrumb-item v-for="(title, index) in _.map(breads, 'meta.title')" :key="index">
                        {{ title }}
                    </el-breadcrumb-item>
                </el-breadcrumb>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>
import Sidebar from './components/Sidebar'
import Headnav from './components/Headnav'
export default {
    name: 'layout',
    components: {
        Sidebar,
        Headnav,
    },
    computed: {
        breads() {
            return this._.filter(this.$route.matched, 'meta.title')
        }
    }
}
</script>
