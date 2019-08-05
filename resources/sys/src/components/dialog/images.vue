<style lang="scss" scoped>
.dialog-img{
    width:200px;
    height:200px;
    text-align:center;
    line-height:200px;
}
</style>

<template>
    <el-dialog title="选择图片" :visible.sync="showDialog" :before-close="handleHide">
        <div v-loading="loading">
            <el-row :gutter="10">
                <el-col :span="6" v-for="item in list" :key="item.id" style="margin-bottom:5px;">
                    <el-card shadow="hover">
                        <el-image :src="item.url" fit="fill"></el-image>
                    </el-card>
                </el-col>
            </el-row>
            <el-pagination small 
                layout="prev, pager, next" 
                :hide-on-single-page="true" 
                :total="count" 
                :page-size="pagesize"
                @current-change="handlePageChange"
            ></el-pagination>
        </div>
        <div slot="footer" class="dialog-footer">
            <el-button type="primary" @click="handlePrimary">确定</el-button>
            <el-button @click="handleHide">取消</el-button>
        </div>
    </el-dialog>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data() {
        return {
            loadComponent: undefined,
        }
    },
    computed: {
        ...mapGetters({
            showDialog: 'resource/showDialog',
            loading: 'resource/listLoading',
            list: 'resource/list',
            page: 'resource/page',
            count: 'resource/count',
            pagesize: 'resource/pagesize',
        })
    },
    mounted() {
        this.$store.dispatch('resource/getImages', {tagid:0, page:1})
    },
    methods: {
        handlePageChange(page) {
            this.$store.dispatch('resource/pageChange', page)
        },
        handlePrimary() {
            console.log(this.pages)
        },
        handleHide() {
            this.$store.dispatch('resource/toggleDialog')
        }
    }
}
</script>
