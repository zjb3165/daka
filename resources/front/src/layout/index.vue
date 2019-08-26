<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: 'layout',
    mounted() {
        this.$store.dispatch('app/getMember')
    }
}
</script>
