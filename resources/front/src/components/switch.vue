<template>
    <div class="daka-switch" :class="[styles, {checked: checkedValue}]" @click="toggle">
        <div class="round"></div>
    </div>
</template>

<script>
export default {
    name: 'daka-switch',
    data() {
        return {
            checkedValue: this.checked,
        }
    },
    model: {
        prop: 'checked',
        event: 'change'
    },
    props: {
        checked: false,
        styles: {
            type: String,
            default: ''
        }
    },
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

.daka-switch{
    position:relative;
    width: torem(100px);
    height: torem(60px);
    border-radius: torem(30px);
    background: #ccc;
    border: 1px solid #ccc;

    .round{
        float: left;
        width: torem(56px);
        height: torem(56px);
        border-radius: 50%;
        background: #fff;
        padding: torem(2px);
    }

    &.checked{
        background: #374674;
        border-color: #374674;

        &.morning{
            background: #f7e234;
            border-color: #f7e234;
        }

        .round{
            float: right;
        }
    }
}
</style>