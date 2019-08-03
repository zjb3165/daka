<template>
    <el-card shadow="never" :body-style="{padding: '20px'}">
        <el-form ref="pwdForm" :model="pwdForm" :rules="rules" label-width="80px">
            <el-form-item label="原密码" prop="oldPassword">
                <el-input type="password" name="oldPassword"
                    v-model="pwdForm.oldPassword"
                    placeholder="请输入原密码"
                    tabindex="1"
                ></el-input>
            </el-form-item>
            <el-form-item label="新密码" prop="newPassword">
                <el-input type="password" name="newPassword"
                    v-model="pwdForm.newPassword"
                    placeholder="请输入新密码"
                    tabindex="2"
                ></el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="retryPassword">
                <el-input type="password" name="retryPassword"
                    v-model="pwdForm.retryPassword"
                    placeholder="请确认密码"
                    tabindex="3"
                ></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" tabindex="4" :loading="loading" @click="handleUpdate">确定</el-button>
            </el-form-item>
        </el-form>
    </el-card>
</template>

<script>
import { Message } from 'element-ui'
export default {
    data() {
        const validatePassword = (rule, value, callback) => {
            if (value.length < 6 || value.length > 20) {
                callback(new Error('请输入正确的密码'))
            } else {
                if (this.pwdForm.retryPassword !== '') {
                    this.$refs.pwdForm.validateField('retryPassword')
                }
                callback()
            }
        }
        const validateRetryPassword = (rule, value, callback) => {
            if (value.length < 6 || value.length > 20) {
                callback(new Error('请输入正确的密码'))
            } else if (value !== this.pwdForm.newPassword) {
                callback(new Error('两次输入的密码不一致'))
            } else {
                callback()
            }
        }
        return {
            loading: false,
            pwdForm: {
                oldPassword: '',
                newPassword: '',
                retryPassword: '',
            },
            rules: {
                oldPassword: [{required: true, trigger: 'blur', message: '请输入原密码'}],
                newPassword: [{required: true, trigger: 'blur', validator: validatePassword}],
                retryPassword: [{required: true, trigger: 'blur', validator: validateRetryPassword}]
            }
        }
    },
    methods: {
        handleUpdate() {
            this.$refs.pwdForm.validate(valid => {
                this.loading = true
                if (valid) {
                    this.$store.dispatch('updatePassword', {
                        oldPassword: this.pwdForm.oldPassword,
                        newPassword: this.pwdForm.newPassword,
                    }).then(() => {
                        Message({
                            message: '修改成功',
                            type: 'success',
                            duration: 5000
                        })
                        this.loading = false
                    }).catch(() => {
                        this.loading = false
                    })
                } else {
                    this.loading = false
                    return false
                }
            })
        }
    }
}
</script>
