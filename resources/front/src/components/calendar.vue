<template>
    <div class="daka-calendar">
        <div class="week-title">
            <div class="week-col" v-for="title in titles" :key="title">{{ title }}</div>
        </div>
        <div class="week-row" v-for="(days, index) in weeks" :key="index">
            <div class="week-day" v-for="day in days" 
                :key="day.date" 
                :class="{other: ! day.currentMonth, choosed: day.choosed}"
                @click.prevent="chooseDate(day.date)"
            >
                <div class="text">{{ day.dateShow }}</div>
                <div class="dot" v-if="day.hasDot"></div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import moment from 'moment'

let vue = new Vue()
export default {
    name: 'DakaCalendar',
    data() {
        return {
            titles: ['一', '二', '三', '四', '五', '六', '日']
        }
    },
    props: {
        month: {
            type: String,
            required: true,
        },
        choosed: {
            type: String,
        },
        dotDates: {
            type: Array,
            default: []
        }
    },
    computed: {
        weeks() {
            let weeks = []
            let day = moment(this.month + '-01').startOf('isoWeek')
            let week = []
            while(true) {
                week.push({
                    date: day.format('YYYY-MM-DD'),
                    dateShow: day.format('DD'),
                    choosed: day.format('YYYY-MM-DD') === this.choosed,
                    hasDot: vue._.indexOf(this.dotDates, day.format('YYYY-MM-DD')) !== -1,
                    currentMonth: day.format('YYYY-MM') === this.month
                })
                day.add(1, 'days')
                if (week.length === 7) {
                    weeks.push(week)
                    week = []
                    
                    if (day.format('YYYY-MM') !== this.month) {
                        break
                    }
                }
            }
            return weeks
        }
    },
    watch: {
        month(newValue, oldValue) {
            console.log('month changed', newValue, oldValue)
        }
    },
    methods: {
        chooseDate(date) {
            this.$emit('changed', date)
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@/front/src/styles/variables.scss';

.daka-calendar{
    position:relative;
    padding: torem(20px);

    .week-title{
        display:flex;
        justify-content: space-around;

        .week-col{
            text-align:center;
            color: #666;
        }
    }

    .week-row {
        display: flex;
        justify-content: space-around;
        padding: torem(10px) 0;

        .week-day{
            position:relative;
            width: torem(75px);
            height: torem(75px);
            line-height: torem(75px);
            text-align:center;
            color: #000;

            &.other{
                color: #cfcfcf;
            }

            &.choosed{
                background: #f7e504;
                border-radius: 50%;
            }

            .dot{
                position:absolute;
                left: 50%;
                bottom: 0;
                width: torem(15px);
                height: torem(15px);
                margin: 0 auto;
                background: #f7e504;
                border-radius: 50%;
                transform: translateX(-50%);
            }
        }
    }
}
</style>