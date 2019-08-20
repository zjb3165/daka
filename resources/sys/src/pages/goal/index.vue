<template>
    <div>
        <el-card shadow="never" :body-style="{padding: '0px'}">
            <div slot="header">
                <el-row type="flex" justify="space-between">
                    <el-col :span="24">
                        <span>打卡目标管理</span>
                    </el-col>
                </el-row>
            </div>
            <el-table v-loading="listLoading" :data="list" :stripe="true">
                <el-table-column prop="id" width="80" align="center"></el-table-column>
                <el-table-column prop="title" label="目标名称"></el-table-column>
                <el-table-column label="打卡时间">
                    <template slot-scope="scope">
                        <span>{{ scope.row.start_time }}:00 - {{ scope.row.end_time }}:00</span>
                    </template>
                </el-table-column>
                <el-table-column prop="credits" label="可得积分" align="center"></el-table-column>
                <el-table-column label="操作" width="120">
                    <template slot-scope="scope">
                        <el-button size="medium" icon="el-icon-edit" @click.prevent.native="editGoal(scope.row.id)">修改</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-card>

        <el-dialog title="修改" :visible.sync="showDialog">
            <el-form ref="updateForm" 
                v-loading="dialogLoading"
                :model="goal" 
                :rules="rules" 
                :label-position="'right'" 
                label-width="120px"
            >
                <el-form-item label="目标名称" prop="title">
                    <el-input v-model="goal.title"
                        name="title"
                        placeholder="请填写目标名称"
                        :disabled="true"
                    ></el-input>
                </el-form-item>
                <el-form-item label="打卡开始时间" prop="start_time">
                    <el-select v-model="goal.start_time"
                        name="start_time"
                        placeholder="请选择开始时间"
                    >
                        <el-option v-for="time in times"
                            :key="time"
                            :label="time + ':00'"
                            :value="time"
                        ></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="打卡结束时间" prop="end_time">
                    <el-select v-model="goal.end_time"
                        name="end_time"
                        placeholder="请选择结束时间"
                    >
                        <el-option v-for="time in times"
                            :key="time"
                            :label="time + ':00'"
                            :value="time"
                        ></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="完成可得积分" prop="credits">
                    <el-input type="number" v-model="goal.credits"
                        name="credits"
                        placeholder="请填写积分"
                    ></el-input>
                </el-form-item>
                <el-form-item label="是否可重复打卡" prop="repeat">
                    <el-radio-group v-model="goal.repeat">
                        <el-radio-button label="1">是</el-radio-button>
                        <el-radio-button label="0">否</el-radio-button>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="打卡完成回复">
                    <el-input type="textarea" v-model="goal.reply"
                        name="reply"
                        placeholder="请填写回复"
                    ></el-input>
                </el-form-item>
                <el-form-item label="已打过卡回复">
                    <el-input type="textarea" v-model="goal.checked_reply"
                        name="checked_reply"
                        placeholder="已打过卡回复"
                    ></el-input>
                </el-form-item>
                <el-form-item label="未在打卡时间内">
                    <el-input type="textarea" v-model="goal.not_in_time_reply"
                        name="not_in_time_reply"
                        placeholder="未在打卡时间内回复"
                    ></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="saveGoal">保存</el-button>
                    <el-button @click="showDialog = false">取消</el-button>
                </el-form-item>
            </el-form>
        </el-dialog>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { Message } from 'element-ui'
export default {
    data() {
        return {
            showDialog: false,
            times: [],
            rules: {
                start_time: [{required: true, trigger: 'blur', message: '请选择开始时间'}],
                end_time: [{required: true, trigger: 'blur', message: '请选择结束时间'}],
                credits: [{required: true, trigger: 'blur', message: '请填写积分'}, {type: 'number', trigger:'keydown', message: '积分必须为整数'}],
            }
        }
    },
    computed: {
        ...mapGetters({
            list: 'goal/list',
            listLoading: 'goal/listLoading',
            goal: 'goal/goal',
            detailLoading: 'goal/detailLoading',
            updating: 'goal/updating',
        }),
        dialogLoading: function() {
            return this.detailLoading || this.updating
        }
    },
    watch: {
        'updating': function() {
            if (this.updating === false) {
                this.showDialog = false
                Message({
                    message: '修改成功',
                    type: 'success',
                    duration: 2000
                })
            }
        }
    },
    mounted() {
        this.$store.dispatch('goal/getList')
        this.times = this._.range(0, 25)
    },
    methods: {
        editGoal(id) {
            this.showDialog = true
            this.$store.dispatch('goal/getDetail', id)
        },
        saveGoal() {
            this.$store.dispatch('goal/update', this.goal)
        }
    }
}
</script>
