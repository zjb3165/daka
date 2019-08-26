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

        </div>
        <toggle :goal-style="style" @click.prevent.native="changeStyle" />
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { MORNING, EVENING } from '../../utils/constants'
import MemberInfo from './components/member_info'
import Toggle from './components/toggle'

export default {
    components: {
        MemberInfo,
        Toggle,
    },
    computed: {
        ...mapGetters({
            member: 'app/member',
            style: 'app/style',
        }),
        statText() {
            return '累计早起30天'
        }
    },
    methods: {
        changeStyle() {
            this.$store.dispatch('app/setStyle', this.style === MORNING ? EVENING : MORNING)
        }
    }
}
</script>