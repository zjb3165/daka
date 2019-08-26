<style lang="scss">
@import '~@/front/src/styles/variables.scss';

.member-info{
    position:relative;
    margin:0 auto;
    padding: torem(35px);
    display:flex;

    .avatar{
        width:torem(125px);
        height:torem(125px);
        border-radius:50%;
        overflow:hidden;

        img{
            width: 100%;
            height: 100%;
        }
    }
    
    .infos{
        padding-left: torem(20px);
        
        .nickname{
            height: torem(70px);
            line-height: torem(70px);
            font-size: torem(32px);
            color: #333;
        }
        
        .text{
            height: torem(60px);
            line-height: torem(60px);
            font-size: torem(24px);
            color:#462b00;
        }
    }
}
</style>

<template>
    <div class="member-info">
        <div class="avatar">
            <img :src="member.avatar" />
        </div>
        <div class="infos">
            <div class="nickname">Hi, {{ member.nickname }}</div>
            <div class="text">{{ text }}</div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: 'MemberInfo',
    props: {
        text: String
    },
    computed: {
        ...mapGetters({
            member: 'app/member'
        })
    }
}
</script>