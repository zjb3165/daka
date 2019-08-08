<style lang="scss">
.user-avatar-50{
    width:50px;
    height:50px;
    border-radius:50%;
}
.user-nickname-50{
    display:inline-block;
    line-height:50px;
    vertical-align: top;
    margin-left:5px;
}
</style>


<template>
    <div>
        <el-card shadow="never" :body-style="{padding: '0px'}">
            <div slot="header">
                <el-row type="flex" justify="space-between">
                    <el-col :span="24">
                        <span>会员管理</span>
                    </el-col>
                </el-row>
            </div>
            <el-table v-loading="listLoading" :data="list" :stripe="true">
                <el-table-column prop="id" width="80" align="center"></el-table-column>
                <el-table-column label="昵称" align="center">
                    <template slot-scope="scope">
                        <el-image :src="scope.row.avatar" :lazy="true" class="user-avatar-50"></el-image>
                        <span class="user-nickname-50">{{ scope.row.nickname }}</span>
                    </template>
                </el-table-column>
                <el-table-column label="推荐人" align="center">
                    <template slot-scope="scope" v-if="scope.row.parent">
                        <el-image :src="scope.row.parent.avatar" class="user-avatar-50"></el-image>
                        <span class="user-nickname-50">{{ scope.row.parent.nickname }}</span>
                    </template>
                </el-table-column>
                <el-table-column prop="gender" label="性别" align="center" 
                    :formatter="sexFormatter"
                ></el-table-column>
                <el-table-column prop="credits" label="积分" align="center"></el-table-column>
                <el-table-column prop="subscribed_at" label="关注时间" align="center"
                    :formatter="timeFormatter"></el-table-column>
                <el-table-column prop="actived_at" label="最后活跃时间" align="center"
                    :formatter="timeFormatter"></el-table-column>
                <el-table-column prop="memos" label="备注"></el-table-column>
                <el-table-column label="操作" width="120">
                    <template slot-scope="scope">
                        <el-button size="medium" type="primary" @click="edit(scope.row.id)">修改备注</el-button>
                    </template>
                </el-table-column>
            </el-table>
            <el-pagination background 
                style="text-align:center;"
                layout="prev, pager, next, total" 
                :hide-on-single-page="true" 
                :total="counts" 
                :page-size="pagesize"
                @current-change="handlePageChange"
            ></el-pagination>
        </el-card>

        <el-dialog title="更新备注" :visible.sync="showDialog">
            <el-form ref="updateForm" 
                v-loading="dialogLoading"
                :model="member" 
                :label-position="'right'" 
                label-width="120px"
            >
                <el-form-item label="会员">
                    <el-input v-model="member.nickname"
                        name="nickname"
                        :disabled="true"
                    ></el-input>
                </el-form-item>
                <el-form-item label="备注">
                    <el-input v-model="member.memos"
                        name="memos"
                        type="textarea"
                        placeholder="请填写备注"
                    ></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="save">保存</el-button>
                    <el-button @click="hideDialog">取消</el-button>
                </el-form-item>
            </el-form>
        </el-dialog>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { Message } from 'element-ui'
import { timeFormatter } from '../../utils/util'
export default {
    computed: {
        ...mapGetters({
            list: 'member/list',
            member: 'member/member',
            listLoading: 'member/listLoading',
            detailLoading: 'member/detailLoading',
            updating: 'member/updating',
            counts: 'member/counts',
            pagesize: 'member/pagesize',
            showDialog: 'member/showDialog',
        }),
        dialogLoading: function() {
            return this.detailLoading || this.updating
        }
    },
    watch: {
        'updating': function() {
            if (this.updating === false) {
                this.$store.dispatch('member/toggleEditDialog', false)
                Message({
                    message: '修改成功',
                    type: 'success',
                    duration: 2000
                })
            }
        }
    },
    mounted() {
        this.$store.dispatch('member/getList')
    },
    methods: {
        sexFormatter(row, col, val, index) {
            return val === 1 ? '男' : (val === 2 ? '女' : '未知')
        },
        timeFormatter(row, col, val, index) {
            return timeFormatter(val, 'Y-m-d H:i')
        },
        handlePageChange(page) {
            this.$store.dispatch('member/changePage', page)
        },
        edit(id) {
            this.$store.dispatch('member/getDetail', id)
            this.$store.dispatch('member/toggleEditDialog')
        },
        save() {
            this.$store.dispatch('member/update', {
                id: this.member.id,
                memos: this.member.memos,
            })
        },
        hideDialog() {
            this.$store.dispatch('member/toggleEditDialog', false)
        }
    }
}
</script>
