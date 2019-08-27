<template>
    <div class="page">
        <div class="date-head">
            <div class="current">
                <span>{{ dateFormatted }}</span>
            </div>
            <div class="month-select">
                <div class="arrow prev" @click="goPrev">&lt;</div>
                <div class="text">{{ monthFormatted }}</div>
                <div class="arrow next" :class="{disabled: !hasNext}" @click="goNext">&gt;</div>
            </div>
        </div>
        <div class="date-panel">
            <daka-calendar :month="month" :choosed="choosed" :dotDates="dotDates" @changed="chooseDate" />
        </div>
        <div class="picture"></div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import moment from 'moment'
import DakaCalendar from '../../components/calendar'

export default {
    components: {
        DakaCalendar,
    },
    computed: {
        ...mapGetters({
            date: 'history/date',
            month: 'history/month',
            list: 'history/list',
            choosed: 'history/choosedDate'
        }),
        hasNext() {
            if (moment(this.date).format('YYYY-MM') === moment(this.month).format('YYYY-MM')) {
                return false
            }
            return true
        },
        dateFormatted() {
            return moment(this.date).format('MM月DD日')
        },
        monthFormatted() {
            return moment(this.month).format('YYYY.MM')
        },
        dotDates() {
            return ['2019-08-14', '2019-08-15', '2019-08-17', '2019-08-22', '2019-08-23', '2019-08-25']
        }
    },
    mounted() {
        this.$store.dispatch('history/getHistory')
    },
    methods: {
        chooseDate(date) {
            this.$store.dispatch('history/chooseDate', date)
        },
        goPrev() {
            this.$store.dispatch('history/goPrev')
        },
        goNext() {
            this.$store.dispatch('history/goNext')
        }
    } 
}
</script>

<style lang="scss" scoped>
@import '~@/front/src/styles/variables.scss';

.page{
    background: #fff;
    padding: torem(20px);
}
.date-head{
    display:flex;
    height: torem(70px);
    line-height: torem(70px);
    padding: torem(20px);
    border-bottom: 1px solid #e9e9e9;
    justify-content: space-between;

    .month-select{
        display:flex;
        justify-content: space-between;

        .text{
            line-height: torem(50px);
            margin: 0 torem(15px);
        }

        .arrow{
            width: torem(50px);
            height: torem(50px);
            background: #f5dd38;
            color: #333;
            text-align: center;
            line-height: torem(50px);
            border-radius: 50%;
            
            &.disabled{
                background: #e8e8e8;
                color: #d3d3d3;
            }
        }
    }
}
</style>