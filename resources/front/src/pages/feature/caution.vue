<template>
    <div class="page">
        <div class="caution-line">
            <div class="line-label">开启每日{{ style === 'morning' ? '早起' : '晚安' }}提醒</div>
            <div class="line-footer">
                <daka-switch :checked="checked" @change="toggleChange" />
            </div>
        </div>
        <div class="caution-panel" v-if="checked">
            <div class="panel-title">
                提醒方式<span>(2选1)</span>
            </div>
            <div class="panel-body">
                <div class="caution-select">
                    <div class="caution-col" :class="{active: type === 1}" @click="choose(1)">
                        <div class="caution-block">
                            <div class="block">
                                <div class="icon"></div>
                                <div class="text">
                                    智能提醒
                                </div>
                            </div>
                        </div>
                        <div class="check-row">
                            <div class="check-btn"></div>
                        </div>
                    </div>
                    <div class="caution-col" :class="{active: type === 2}" @click="choose(2)">
                        <div class="caution-block">
                            <div class="block">
                                <div class="icon">
                                </div>
                                <div class="text">
                                    自定义提醒
                                </div>
                            </div>
                        </div>
                        <div class="check-row">
                            <div class="check-btn"></div>
                        </div>
                    </div>
                </div>
                <div class="caution-tips">
                    <div class="text" v-if="type === 1">系统根据你最近的平均打卡时间<br />发送一条消息提醒你打卡</div>
                    <template v-else>
                        <div class="caution-line">
                            <div class="line-label">设定提醒时间</div>
                            <div class="label-footer">
                                <input type="time" v-model="time" />
                            </div>
                        </div>
                        <div class="text">系统会在你设定的时间<br />发送一条消息提醒你打卡</div>
                    </template>
                </div>
                <div class="caution-btns">
                    <div class="btn save" @click="save">保存</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import DakaSwitch from '../../components/switch'

export default {
    components: {
        DakaSwitch
    },
    computed: {
        ...mapGetters({
            style: 'app/style',
            checked: 'caution/checked',
            type: 'caution/type',
            time: 'caution/time',
        })
    },
    methods: {
        toggleChange(value) {
            this.$store.dispatch('caution/toggleCheck', {
                code: this.style,
                status: value
            })
        },
        choose(type) {
            this.$store.dispatch('caution/setType', type)
        },
        save() {
            console.log('save')
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@/front/src/styles/variables.scss';
.page{
    padding: torem(30px);
    background: #fff;
}
.caution-line{
    display:flex;
    height: torem(60px);
    line-height: torem(60px);
    padding: torem(15px);
    justify-content: space-between;
    border-bottom: 1px solid #eee;
    font-weight: bold;
}
.caution-panel{
    padding-top: torem(40px);

    .panel-title{
        font-weight: bold;

        span{
            font-weight: normal;
            font-size: torem(28px);
            margin-left: torem(15px);
        }
    }

    .caution-select{
        padding-top: torem(40px);
        padding-bottom: torem(40px);
        display:flex;
        justify-content: space-around;

        .caution-col{
            width: 50%;
            
            .caution-block{
                margin: 0 auto;
                width: torem(245px);
                height: torem(245px);
            }

            .block{
                margin: 0 auto;
                width: torem(200px);
                height: torem(200px);
                background: #f6f6f6;
                transform: translateY(torem(22px));
                
                .icon{
                    margin: 0 auto;
                    width: torem(80px);
                    height: torem(80px);
                    transform: translateY(torem(40px));
                    color: #cfcfcf;
                }
                .text{
                    margin-top: torem(30px);
                    text-align:center;
                    color: #cfcfcf;
                    font-size: torem(26px);
                }
            }

            .check-row{
                text-align:center;
                margin-top: torem(30px);

                .check-btn{
                    margin: 0 auto;
                    width: torem(40px);
                    height: torem(40px);
                    border-radius: 50%;
                    border: 1px solid #959595;
                }
            }
            
            &.active{
                .block{
                    width: torem(245px);
                    height: torem(245px);
                    background: #fff;
                    box-shadow: 0 0 torem(25px) torem(5px) #eee;
                    transform: translateY(0);
                }

                .check-btn{
                    border-color: #1d2a4f;
                    background: #1d2a4f;
                    color: #fff;
                }
            }
        }
    }

    .caution-tips{
        font-size: torem(28px);
        text-align:center;
        color: #333;
        padding: torem(20px) 0;
    }

    .caution-btns{
        text-align:center;
        padding: torem(25px) 0;

        .btn{
            width: torem(520px);   
            height: torem(80px);
            line-height: torem(80px);
            display:inline-block;
            background: #ccc;
            color: #727272;
            border-radius: torem(40px);
        }
    }
}
</style>