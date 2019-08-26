<template>
    <div>nickname:{{ member.nickname }}</div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    computed: {
        ...mapGetters({
            member: 'app/member'
        })
    }
}
</script>