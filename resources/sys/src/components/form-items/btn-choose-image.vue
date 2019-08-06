<style lang="scss">
.form-image-choose{
    position:relative;
    .form-image-item
    {
        position:relative;
        display:inline-block;
        margin:5px;
        border: 1px solid #DCDFE6;
        border-radius:5px;
        overflow:hidden;
        text-align:center;
        vertical-align: top;
        line-height:0;

        .mask{
            position:absolute;
            bottom:0;
            left:0;
            right:0;
            height:40px;
            background:rgba(0,0,0,.7);
            color:#fff;

            .move-icon{
                position:absolute;
                height:40px;
                line-height:40px;
                cursor:pointer;

                &.left{
                    top:0;
                    left:5px;
                }
                &.right{
                    top:0;
                    right:5px;
                }
                &.delete{
                    top:0;
                    left:50%;
                    transform: translate(-50%, 0);
                }
            }
        }

        .icon{
            position:absolute;
            top:50%;
            left:50%;
            width:25px;
            height:25px;
            transform: translate(-50%, -50%);
            font-size:30px;
        }

        &.single {
            position:absolute;
            top:0;
            left:0;
            right:0;
            bottom:0;
            border:none;

            .icon{
                display:none;
            }
        }
    }
}
</style>


<template>
    <div class="form-image-choose">
        <div v-for="(item, index) in images" 
            :key="item" 
            class="form-image-item" 
            :style="{'width': itemSize + 'px'}"
        >
            <el-image :src="'/storage/uploads/' + item" fit="contain" :style="{height: itemSize + 'px'}" />
            <div class="mask" v-if="multiple">
                <div class="move-icon left" v-if="images.length > 1 && index > 0" @click.stop="moveLeft(index)"><i class="el-icon-arrow-left"></i></div>
                <div class="move-icon right" v-if="images.length > 1 && index < (images.length - 1)" @click.stop="moveRight(index)"><i class="el-icon-arrow-right"></i></div>
                <div class="move-icon delete" @click.stop="deleteItem(index)"><i class="el-icon-delete"></i></div>
            </div>
        </div>
        <div class="form-image-item" 
            :class="{single: !multiple && images.length > 0}"
            @click="showImageDialog"
            :style="{width: itemSize + 'px', height: itemSize + 'px'}"
            @click.native.prevent="showImageDialog"
        >
            <i class="icon el-icon-plus"></i>
        </div>
    </div>
</template>

<script>
import { EventBus } from '../../event-bus'

export default {
    props: {
        value: [String, Array],
        name: {
            type: String,
            required: true,
        },
        multiple: {
            type: Boolean,
            default: false,
        },
        itemSize: {
            type: Number,
            default: 150,
        },
    },
    computed: {
        images: {
            get: function() {
                if (this.multiple) {
                    if (this.value && this.value.length) return this.value
                    return []
                } else {
                    if (!this.value || this.value === '') return []
                    return [this.value]
                }
            },
            set: function(value) {
                this.$emit('input', this.multiple ? value : value[0])
            }
        }
    },
    mounted() {
        EventBus.$on('image-dialog-check-result', (opener, images) => {
            if (this.name !== opener || images.length <= 0) return
            if (this.multiple) {
                this.images = this._.union(this.images, images)
            } else {
                this.images = [images[0]]
            }
        })
    },
    methods: {
        showImageDialog() {
            EventBus.$emit('image-dialog-show', this.name, this.multiple)
        },
        showImageDialogSingle() {
            if (! this.multiple) {
                this.showImageDialog()
            }
        },
        moveLeft(idx) {
            if (idx <= 0) return
            this.images[idx - 1] = this.images.splice(idx, 1, this.images[idx - 1])
        },
        moveRight(idx) {
            if (idx >= (this.images.length - 1)) return
            this.images[idx] = this.images.splice(idx + 1, 1, this.images[idx])
        },
        deleteItem(idx) {
            this.images = this._.filter(this.images, (item, index) => {
                return index != idx
            })
        }
    }
}
</script>
