<template>
    <router-view></router-view>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: 'layout',
    computed: {
        ...mapGetters({
            style: 'app/style',
        })
    },
    mounted() {
        this.$store.dispatch('app/getMember')
    }
}
</script>
