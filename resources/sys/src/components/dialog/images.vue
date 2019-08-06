<style lang="scss">
.image-dialog-container{
    max-height: 500px;
    overflow-x: hidden;
    overflow-y: auto;

    .image-list{
        flex-wrap: wrap;
    }
}
</style>


<template>
    <el-dialog :visible.sync="showDialog" :before-close="handleHide">
        <el-row slot="title" type="flex" justify="space-between">
            <span>选择图片</span>
            <el-upload :action="uploadAction" 
                       :headers="{Authorization:'Bearer ' + token}" 
                       :multiple="true" 
                       :data="{type:'image'}"
                       :name="'file'"
                       :show-file-list="false"
                       :accept="'image/gif,image/jpeg,image/png,image/jpg'"
                       :on-success="handleUpload"
                       style="margin-right:30px;"
            >
                <el-button size="small" type="primary">选择图片</el-button>
            </el-upload>
        </el-row>
        <div class="image-dialog-container" v-loading="loading">
            <el-row class="image-list" :gutter="5" type="flex" justify="space-around">
                <el-col class="image-item" :span="6" v-for="item in list" :key="item.id">
                    <check-image shadow="never" :src="item.url" :checked="item.checked" @click.prevent.native="toggleCheck(item.id)" />
                </el-col>
            </el-row>
        </div>
        <el-pagination small 
            style="text-align:center;"
            layout="prev, pager, next" 
            :hide-on-single-page="true" 
            :total="count" 
            :page-size="pagesize"
            @current-change="handlePageChange"
        ></el-pagination>
        <div slot="footer" class="dialog-footer">
            <el-button @click="handleHide">取消</el-button>
            <el-button type="primary" @click="handlePrimary">确定</el-button>
        </div>
    </el-dialog>
</template>

<script>
import { mapGetters } from 'vuex'
import CheckImage from './check-image'
import { EventBus } from '../../event-bus'

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
            uploadAction: 'resource/uploadAction',
            token: 'token',
        })
    },
    mounted() {
        EventBus.$on('image-dialog-show', function(opener, multiple){
            this.$store.dispatch('resource/toggleDialog', {
                opener: opener,
                multiCheck: multiple
            })
        }.bind(this))
    },
    methods: {
        toggleCheck(id) {
            this.$store.dispatch('resource/toggleCheck', id)
        },
        handleUpload(response, fileList) {
            if (response.code === 0) {
                this.$store.dispatch('resource/appendResource', response.resource)
            }
        },
        handlePageChange(page) {
            this.$store.dispatch('resource/pageChange', page)
        },
        handlePrimary() {
            let list = this._.map(this.checkedList, 'path')
            this.$emit('check-result', this.opener, list)
            EventBus.$emit('image-dialog-check-result', this.opener, list)
            this.$store.dispatch('resource/toggleDialog')
        },
        handleHide() {
            this.$store.dispatch('resource/toggleDialog')
        }
    }
}
</script>
