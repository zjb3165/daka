<template>
    <div class="page">
        <div class="head-container" :class="[style]">
            <member-info :text="statText" />
        </div>
        <div class="head-btns">
            <div class="btn">
                <div class="icon"></div>
                <div class="text">提醒</div>
            </div>
            <div class="btn">
                <div class="icon"></div>
                <div class="text">补签</div>
            </div>
            <div class="btn">
                <div class="icon"></div>
                <div class="text">历史</div>
            </div>
            <div class="btn">
                <div class="icon"></div>
                <div class="text">成就</div>
            </div>
        </div>
        <div class="stat-img">
            <img v-if="stat.record" :src="stat.record.picture" />
        </div>
        <toggle :goal-style="style" @click.prevent.native="changeStyle" />
        <home-nav v-if="showNav" :active="0" />
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { MORNING, EVENING } from '../../utils/constants'
import MemberInfo from './components/member_info'
import Toggle from './components/toggle'
import HomeNav from './components/home_nav'

export default {
    components: {
        MemberInfo,
        Toggle,
        HomeNav,
    },
    computed: {
        ...mapGetters({
            member: 'app/member',
            style: 'app/style',
            stat: 'member/stat',
        }),
        statText() {
            let text = this.style === MORNING ? '早起' : '早睡'
            return '累计' + text + this.stat.total + '天'
        },
        showNav() {
            return this.style === MORNING
        }
    },
    mounted() {
        this.$store.dispatch('member/getStat', this.style)
    },
    methods: {
        changeStyle() {
            this.$store.dispatch('app/setStyle', this.style === MORNING ? EVENING : MORNING)
        }
    }
}
</script>