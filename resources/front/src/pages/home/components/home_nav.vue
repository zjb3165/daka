<template>
    <div>
        <div class="home-nav">
            <div class="nav-btn" :class="{'active': active === 0}">
                <div class="icon"></div>
                <div class="text">我的</div>
            </div>
            <div class="nav-btn" :class="{'active': active === 1}">
                <div class="icon"></div>
                <div class="text">排名</div>
            </div>
            <div class="nav-btn" :class="{'active': active === 2}">
                <div class="icon"></div>
                <div class="text">好友</div>
            </div>
            <div class="nav-btn" :class="{'active': active === 3}">
                <div class="icon"></div>
                <div class="text">作息</div>
            </div>
        </div>
        <div class="home-nav-fixed"></div>
    </div>
</template>

<script>
export default {
    name: 'HomeNav',
    props: {
        active: {
            type: Number,
            default: 0
        }
    }
}
</script>