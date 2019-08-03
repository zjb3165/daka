<style lang="scss">
$bg:#283443;
$light_gray:#fff;
$cursor: #fff;


@supports (-webkit-mask: none) and (not (cater-color: $cursor)) {
  .login-container .el-input input {
    color: $cursor;
  }
}

/* reset element-ui css */
.login-container {
  .el-input {
    display: inline-block;
    height: 47px;

    input {
      background: transparent;
      border: 0px;
      -webkit-appearance: none;
      border-radius: 0px;
      color: $light_gray;
      height: 47px;
      caret-color: $cursor;

      &:-webkit-autofill {
        box-shadow: 0 0 0px 1000px $bg inset !important;
        -webkit-text-fill-color: $cursor !important;
      }
    }
  }

  .el-form-item {
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    color: #454545;
  }
}
</style>

<style lang="scss" scoped>
$bg:#2d3a4b;
$dark_gray:#889aa4;
$light_gray:#eee;

.login-container {
  min-height: 100%;
  width: 100%;
  background-color: $bg;
  overflow: hidden;

  .login-form {
    position: relative;
    width: 520px;
    max-width: 100%;
    padding: 160px 35px 0;
    margin: 0 auto;
    overflow: hidden;
  }

  .title-container {
    position: relative;

    .title {
      font-size: 26px;
      color: $light_gray;
      margin: 0px auto 40px auto;
      text-align: center;
      font-weight: bold;
    }
  }
}
</style>

<template>
    <div class="login-container">
        <el-form ref="loginForm" :model="loginForm" :rules="loginRules" class="login-form" auto-complete="on">
            <div class="title-container">
                <h3 class="title">登陆</h3>
            </div>
            <el-form-item prop="username">
                <el-input ref="username" 
                    v-model="loginForm.username" 
                    prefix-icon="el-icon-user-solid" 
                    placeholder="用户名" 
                    name="username" 
                    type="text" 
                    tabindex="1" 
                    autocomplete="on"></el-input>
            </el-form-item>
            
            <el-form-item prop="password">
                <el-input ref="password" 
                    type="password" 
                    v-model="loginForm.password" 
                    prefix-icon="el-icon-lock" 
                    placeholder="密码" 
                    name="password" 
                    tabindex="2" 
                    autocomplete="on"
                    @keyup.enter.native="handleLogin"></el-input>
                </span>
            </el-form-item>
            
            <el-button :loading="loading" type="primary" style="width:100%;margin-bottom:30px;"
                @click.native.prevent="handleLogin">登陆</el-button>
        </el-form>
    </div>
</template>

<script>
import { validUsername } from '../utils/validate'
export default {
    name: 'Login',
    data() {
        return {
            loginForm: {
                username: '',
                password: '',
            },
            loginRules: {
                username: [{required: true, trigger: 'blur', 'message': '请输入用户名'}],
                password: [{required: true, trigger: 'blur', min: 6, max: 20, message: '请输入正确的密码'}],
            },
            loading: false,
            showPassword: false,
            redirect: undefined,
        }
    },
    watch: {
        handler: function(route) {
            this.redirect = route.query && route.query.redirect
        },
        immediate: true,
    },
    methods: {
        handleLogin() {
            this.$refs.loginForm.validate(valid => {
                if (valid) {
                    this.loading = true
                    this.$store.dispatch('login', this.loginForm).then(() => {
                        this.$router.push({ path: this.redirect || '/' })
                        this.loading = false
                    }).catch(() => {
                        this.loading = false
                    });
                } else {
                    this.loading = false
                    return false
                }
            })
        }
    }
}
</script>
