<template>
    <div class="daka-check" :class="{checked: checkedValue}" @click="toggle">
        
    </div>
</template>

<script>
export default {
    name: 'daka-check',
    data() {
        return {
            checkedValue: this.checked,
        }
    },
    model: {
        prop: 'checked',
        event: 'change'
    },
    props: ['checked'],
    methods: {
        toggle() {
            this.checkedValue = ! this.checkedValue
            this.$emit('change', this.checkedValue)
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@/front/src/styles/variables.scss';
.daka-check{
    margin: 0 auto;
    width: torem(40px);
    height: torem(40px);
    border-radius: 50%;
    border: 1px solid #959595;
    
    &.checked{
        border-color: #1d2a4f;
        background: #1d2a4f;
        color: #fff;
    }
}
</style>