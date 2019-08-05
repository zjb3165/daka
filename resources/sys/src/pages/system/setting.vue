<template>
    <div>
        <el-card shadow="never" :body-style="{padding: '0px'}">
            <div slot="header">
                <el-row type="flex" justify="space-between">
                    <el-col :span="12">
                        <span>微信系统设置</span>
                    </el-col>
                </el-row>
            </div>
            <el-form :label-position="'right'" label-width="200px" style="padding-top:20px;">
                <el-form-item label="微信公众号名称">
                    <el-input placeholder="请填写公众号名称"
                        v-model="setting.name"
                        tabindex="1"
                    ></el-input>
                </el-form-item>
                <el-form-item label="微信公众号APPID">
                    <el-input placeholder="请填写公众号APPID"
                        v-model="setting.appid"
                        tabindex="2"
                    ></el-input>
                </el-form-item>
                <el-form-item label="微信公众号APPSECRET">
                    <el-input placeholder="请填写公众号APPSECRET"
                        v-model="setting.appsecret"
                        tabindex="3"
                    ></el-input>
                </el-form-item>
                <el-form-item label="开发TOKEN">
                    <el-input placeholder="请填写开发TOKEN"
                        v-model="setting.token"
                        tabindex="4"
                    ></el-input>
                </el-form-item>
                <el-form-item label="EncodingAESKey">
                    <el-input placeholder="请填写EncodingAESKey"
                        v-model="setting.aeskey"
                        tabindex="5"
                    ></el-input>
                </el-form-item>
                <el-form-item label="公众号二维码">
                    <el-input placehlder="请选择二维码"
                        v-model="setting.qrcode"
                    ></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button @click="toggleDialog">选择图片</el-button>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="handleSave">保存</el-button>
                </el-form-item>
            </el-form>
        </el-card>
        <image-dialog></image-dialog>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { Message } from 'element-ui'
import ImageDialog from '../../components/dialog/images'
export default {
    data() {
        return {
            showImageDlg: false,
        }
    },
    components: {
        ImageDialog,
    },
    created() {
        this.$store.dispatch('settings/getSetting', 'wechat')
    },
    computed: {
        ...mapGetters({
            setting: 'settings/setting',
        })
    },
    methods: {
        toggleDialog() {
            this.$store.dispatch('resource/toggleDialog')
        },
        handleSave() {
            this.$store.dispatch('settings/saveSetting', {
                code: 'wechat',
                params: this.setting
            }).then(() => {
                Message({
                    message: '保存成功',
                    type: 'success',
                    duration: 2000,
                })
            })
        }
    }
}
</script>
