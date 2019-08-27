<template>
    <div class="page">
        <div class="head-container" :class="[style]">
            <div class="stat-btns">
                <div class="stat-btn" :class="{active:type === 'week'}" @click="changeType('week')">周统计</div>
                <div class="stat-btn" :class="{active:type === 'month'}" @click="changeType('month')">月统计</div>
            </div>
            <div class="date-view">
                <div class="prev arrow" @click="prev">&lt;</div>
                <div class="text">
                    <template v-if="type === 'week'">{{ startDate }}至{{ endDate }}</template>
                    <template v-else>{{ month }}</template>
                </div>
                <div class="next arrow" v-if="showNext" @click="next">&gt;</div>
            </div>
        </div>
        <div class="time-panel">
            <div class="time-block">
                <div class="time getup">07:33</div>
                <div class="text">平均早起</div>
            </div>
            <div class="time-block">
                <div class="time stime">08<span>时</span>15<span>分</span></div>
                <div class="text">平均睡眠</div>
            </div>
            <div class="time-block">
                <div class="time sleep">22:00</div>
                <div class="text">平均入睡</div>
            </div>
        </div>
        <div class="getup-panel panel">
            <div class="panel-title">
                <span>早起统计</span>
            </div>
            <div class="panel-body">
                <div class="chart"></div>
            </div>
        </div>
        <div class="sleep-panel panel">
            <div class="panel-title">
                <span>睡眠统计</span>
            </div>
            <div class="panel-body">
                <div class="chart"></div>
            </div>
        </div>
        <div class="gosleep-panel panel">
            <div class="panel-title">
                <span>入睡统计</span>
            </div>
            <div class="panel-body">
                <div class="chart"></div>
            </div>
        </div>
        <home-nav :active="2" />
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import HomeNav from './components/home_nav'

export default {
    components: {
        HomeNav,
    },
    computed: {
        ...mapGetters({
            style: 'app/style',
            type: 'rest/type',
            startDate: 'rest/startDate',
            endDate: 'rest/endDate',
            month: 'rest/month',
            showNext: 'rest/showNext',
        })
    },
    methods: {
        changeType(type) {
            this.$store.dispatch('rest/setType', type)
        },
        prev() {
            this.$store.dispatch('rest/goPrev')
        },
        next() {
            this.$store.dispatch('rest/goNext')
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@/front/src/styles/variables.scss';
.head-container {
    padding-top: torem(30px);
    .stat-btns{
        margin:0 auto;
        width: torem(300px);
        height: torem(60px);
        line-height: torem(60px);
        border-radius: torem(10px);
        overflow:hidden;
        border: 1px solid #333;
        display:flex;

        .stat-btn{
            text-align:center;
            background:transparent;
            color: #292926;
            font-size: torem(32px);
            width: 50%;
            
            &.active{
                background-color: #333;
                color: #fff;
            }
        }
    }

    .date-view{
        margin: 0 auto;
        padding-top: torem(40px);
        width: torem(480px);
        height: torem(50px);
        line-height: torem(50px);
        font-size: torem(32px);
        display:flex;
        justify-content:start;

        .arrow{
            width: torem(50px);
            height: torem(50px);
            line-height: torem(50px);
            border: 1px solid #333;
            color: #333;
            border-radius: 50%;
            text-align:center;
            font-weight: bold;
        }
        
        .text{
            width: torem(380px);
            text-align:center;
            color: #333;
            font-size: torem(28px);
        }
    }
}
.time-panel{
    margin: 0 auto;
    width: torem(640px);
    height: torem(165px);
    margin-top: torem(-80px);
    border-radius: torem(20px);
    background-color: #fff;
    box-shadow: torem(5px) torem(15px) torem(5px) #f2f2f2;
    display:flex;
    justify-content: space-around;

    .time-block{
        padding-top: torem(30px);
        text-align: center;
        .time{
            font-size: torem(48px);

            &.getup{
                color: #ef914f;
            }
            &.sleep{
                color: #5098e3;
            }
            &.stime{
                color: #4dc6ba;
            }
            
            span{
                font-size: torem(32px);
            }
        }
        .text{
            font-size: torem(32px);
            height: torem(50px);
            line-height: torem(50px);
            color: #666;
        }
    }
}
.panel{
    margin: 0 auto;
    margin-top: torem(30px);
    width: torem(640px);
    background-color: #fff;
    border: 1px solid #eee;
    border-radius: torem(30px);
    box-shadow: torem(5px) torem(15px) torem(5px) #f2f2f2;
    padding: torem(30px);
    box-sizing: border-box;

    .panel-title{
        line-height: torem(70px);

        span{
            font-size: torem(42px);
            color: #333;
        }
    }

    .chart{
        margin: 0 auto;
        width: torem(600px);
        height: torem(600px);
    }
}
</style>