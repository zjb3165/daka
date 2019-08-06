<style lang="scss">
.img-item {
    position:relative;

    .mask{
        position:absolute;
        top:0;
        left:0;
        right:0;
        bottom:0;
        background:rgba(0,0,0,.7);
        color:#fff;
        text-align:center;

        .mask-icon{
            position:absolute;
            left:0;
            right:0;
            top: 50%;
            text-align:center;
            font-size:40px;
            transform: translateY(-50%);
        }
    }
}
</style>

<template>
    <el-card class="img-item" :shadow="shadow">
        <el-image :src="src" :fit="fit" />
        <div class="mask" v-if="checked">
            <i class="mask-icon el-icon-check"></i>
        </div>
    </el-card>
</template>

<script>
export default {
    props: {
        shadow: {
            type: String,
            default: 'never'
        },
        src: {
            type: String,
            required: true,
        },
        fit: {
            type: String,
            default: 'fill'
        },
        checked: {
            type: Boolean,
            default: false
        }
    }
}
</script>
