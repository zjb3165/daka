<style lang="scss">
@import '~@/front/src/styles/variables.scss';

.toggle{
    position:absolute;
    top:0;
    right:torem(45px);
    width: torem(54px);
    z-index:999;
    cursor:pointer;
    
    .line {
        height: torem(110px);
        width: torem(4px);
        margin: 0 auto;
    }
    
    .icon{
        width: torem(54px);
        height: torem(54px);
        border-radius: 50%;
        overflow:hidden;
        
        img{
            width: 100%;
            height: 100%;
        }
    }

    &.morning{
        .line{
            background: #25284c;
        }
        .icon{
            background: #25284c;
        }
    }
    &.evening{
        .line{
            background: #f9ee69;
        }
        .icon{
            background: #f9ee69;
        }
    }
}
</style>

<template>
    <div class="toggle" :class="[goalStyle]">
        <div class="line"></div>
        <div class="icon"></div>
    </div>
</template>

<script>
export default {
    name: 'toggle',
    props: {
        goalStyle: {
            type: String,
            default: 'morning',
        }
    }
}
</script>