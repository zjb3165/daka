<template>
    <div>
        <el-card shadow="never" :body-style="{padding: '0px'}">
            <div slot="header">
                <el-row type="flex" justify="space-between">
                    <el-col :span="12">
                        <span>系统用户管理</span>
                    </el-col>
                    <el-col :span="12">
                        <el-row type="flex" justify="end">
                            <el-button icon="el-icon-plus" @click="handleNew">添加管理员</el-button>
                        </el-row>
                    </el-col>
                </el-row>
            </div>
            <el-table v-loading="listLoading" :data="list" :stripe="true">
                <el-table-column prop="id" label="id" width="80" align="center"></el-table-column>
                <el-table-column prop="username" label="用户名"></el-table-column>
                <el-table-column prop="name" label="姓名"></el-table-column>
                <el-table-column label="操作" width="250">
                    <template slot-scope="scope">
                        <el-button size="medium" icon="el-icon-edit" @click="handleEdit(scope.row.id)">修改</el-button>
                        <el-popover v-model="showDeletePopover[scope.row.id]" v-if="scope.row.username !== 'root'" placement="top">
                            <p style="text-align:center;">确定要删除吗？</p>
                            <div style="text-align:center;">
                                <el-button size="mini" type="primary" :loading="deletePopoverLoading[scope.row.id]" @click="handleDelete(scope.row.id)">确定</el-button>
                                <el-button size="mini" @click="showDeletePopover[scope.row.id] = false">取消</el-button>
                            </div>
                            <el-button size="medium" slot="reference" icon="el-icon-delete" type="danger">删除</el-button>
                        </el-popover>
                    </template>
                </el-table-column>
            </el-table>
        </el-card>
        
        <el-dialog :title="dlgTitle" :visible.sync="dialogVisible">
            <el-form ref="adminForm" :model="adminForm" :rules="rules" :label-position="'right'" label-width="80px">
                <el-form-item label="用户名" prop="username">
                    <el-input v-model="adminForm.username" 
                        name="username" 
                        placeholder="请输入用户名"
                        :disabled="mode === 'edit'"
                        tabindex="1"
                    />
                </el-form-item>
                <el-form-item label="姓名" prop="name">
                    <el-input v-model="adminForm.name" 
                        name="name" 
                        placeholder="请输入姓名"
                        tabindex="2"
                    />
                </el-form-item>
                <el-form-item label="密码" prop="password">
                    <el-input name="password" 
                        v-model="adminForm.password"
                        :placeholder="passwordTip"
                        tabindex="3"
                    />
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button type="primary" :loading="formLoading" @click="handleSave">保存</el-button>
                <el-button @click="dialogVisible = false">取消</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
import { Message } from 'element-ui'
export default {
    data() {
        return {
            listLoading: false,
            dialogVisible: false,
            showDeletePopover: {},
            deletePopoverLoading: {},
            mode: '',
            dlgTitle: '',
            passwordTip: '请填写密码，在6-20位之间',
            adminForm: {
                username: '',
                name: '',
                password: '',
            },
            rules: {},
            formLoading: false,
        }
    },
    created() {
        this.listLoading = true
        this.$store.dispatch('admins/getList').then(() => {
            this.listLoading = false
        })
    },
    computed: {
        list() {
            return this.$store.getters['admins/list']
        }
    },
    methods: {
        handleNew() {
            const validUserName = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请填写用户名'))
                    return
                }
                this.$store.dispatch('admins/check', value).then(() => {
                    if (this.$store.getters['admins/usernameExists']) {
                        callback(new Error('用户名已存在，请重新选择用户名'))
                    } else {
                        callback()
                    }
                })
            }
            this.dlgTitle = '添加新用户'
            this.dialogVisible = true
            this.mode = 'create'
            this.passwordTip = '请填写密码，在6-20位之间'
            this.rules = {
                username: [
                    {required: true, trigger: 'blur', message:'必须填写用户名'}, 
                    {min:4, max: 12, message: '长度在4-12位字符', trigger: 'blur'},
                    {trigger: 'blur', validator: validUserName}
                ],
                name: [{required: true, trigger: 'blur', message: '必须填写姓名'}],
                password: [{required: true, trigger: 'blur', message: '必须填写密码'}, {min:6, max: 20, message: '长度在6-20位字符', trigger:'blur'}],
            }
            this.adminForm = {
                username: '',
                name: '',
                password: '',
            }
        },
        handleCreate() {
            this.$refs.adminForm.validate(valid => {
                this.formLoading = true
                if (valid) {
                    this.$store.dispatch('admins/add', this.adminForm)
                        .then(() => {
                            this.formLoading = false
                            this.dialogVisible = false
                            Message({
                                message: '添加成功',
                                type: 'success',
                                duration: 2000
                            })
                        }).catch(() => {
                            this.formLoading = false
                        })
                } else {
                    this.formLoading = false
                }
            })
        },
        handleEdit(id) {
            this.$store.dispatch('admins/get', id).then(() => {
                const validPassword = (rule, value, callback) => {
                    if (value !== '' && (value.length <6 || value.length > 20)) {
                        callback('长度在6-20位字符')
                    } else {
                        callback()
                    }
                }
                this.dlgTitle = '修改用户',
                this.dialogVisible = true
                this.passwordTip = '如果不需要修改密码，请留空'
                this.mode = 'edit'
                this.rules = {
                    name: [{required:true, trigger: 'blur', message: '必须填写姓名'}],
                    password: [{trigger: 'blur', validator: validPassword}]
                }

                this.adminForm = {
                    id: this.$store.getters['admins/user'].id,
                    username: this.$store.getters['admins/user'].username,
                    name: this.$store.getters['admins/user'].name,
                    password: '',
                }
            })
        },
        handleUpdate() {
            this.$refs.adminForm.validate(valid => {
                this.formLoading = true
                if (valid) {
                    this.$store.dispatch('admins/update', {
                        id: this.adminForm.id,
                        name: this.adminForm.name,
                        password: this.adminForm.password,
                    }).then(() => {
                        this.formLoading = false
                        this.dialogVisible = false
                        Message({
                            message: '修改成功',
                            type: 'success',
                            duration: 2000
                        })
                    }).catch(() => {
                        this.formLoading = false
                    })
                } else {
                    this.formLoading = false
                }
            })
        },
        handleSave() {
            if (this.mode === 'edit') {
                this.handleUpdate()
            } else {
                this.handleCreate()
            }
        },
        handleDelete(id) {
            this.deletePopoverLoading[id] = true
            this.$store.dispatch('admins/delete', id).then(() => {
                this.showDeletePopover[id] = false
                this.deletePopoverLoading[id] = false
            }).catch(() => {
                this.showDeletePopover[id] = false
                this.deletePopoverLoading[id] = false
            })
        }
    }
}
</script>
