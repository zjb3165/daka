<template>
    <el-dialog title="选择图片" :visible.sync="showDialog" :before-close="handleHide">
        <div v-loading="loading">
            <el-row :gutter="10">
                <el-col :span="6" v-for="item in list" :key="item.id" style="margin-bottom:5px;">
                    <check-image shadow="hover" :src="item.url" :checked="item.checked" @click.prevent.native="toggleCheck(item.id)" />
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
            <el-button @click="handleHide">取消</el-button>
            <el-button type="primary" @click="handlePrimary">确定</el-button>
        </div>
    </el-dialog>
</template>

<script>
import { mapGetters } from 'vuex'
import CheckImage from './check-image'
export default {
    components: {
        CheckImage
    },
    computed: {
        ...mapGetters({
            opener: 'resource/opener',
            showDialog: 'resource/showDialog',
            loading: 'resource/listLoading',
            list: 'resource/list',
            checkedList: 'resource/checkedList',
            page: 'resource/page',
            count: 'resource/count',
            pagesize: 'resource/pagesize',
        })
    },
    mounted() {
        this.$store.dispatch('resource/getImages', {tagid:0, page:1})
    },
    methods: {
        toggleCheck(id) {
            this.$store.dispatch('resource/toggleCheck', id)
        },
        handlePageChange(page) {
            this.$store.dispatch('resource/pageChange', page)
        },
        handlePrimary() {
            this.$emit('check-result', this.opener, this.checkedList)
            this.$store.dispatch('resource/toggleDialog')
        },
        handleHide() {
            this.$store.dispatch('resource/toggleDialog')
        }
    }
}
</script>
