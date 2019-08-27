<template>
    <div class="page">
        <div class="alert">开启通知后，好友打卡时你会收到消息提醒哦！</div>
        <div class="notice-head">
            <div class="friend-count"><span>{{ friendCount }}</span>个好友</div>
            <div class="notice-title">
                <span>早打卡</span>
                <span>晚打卡</span>
            </div>
        </div>
        <div class="friend-list">
            <div class="first-row">
                <div class="info">
                    <div class="h-title">霸榜通知</div>
                    <div class="tips">每天第一个打卡的好友通知</div>
                </div>
                <div class="notice-info">
                    <span>
                        <daka-switch styles="morning" :checked="first.morning" />
                    </span>
                    <span>
                        <daka-switch :checked="first.evening" />
                    </span>
                </div>
            </div>
            <div class="friend-row" v-for="friend in friends" :key="friend.id">
                <div class="friend-info">
                    <div class="avatar">
                        <img :src="friend.avatar" />
                    </div>
                    <div class="nickname">{{ friend.nickname }}</div>
                </div>
                <div class="notice-info">
                    <span>
                        <daka-switch styles="morning" :checked="friend.morning" />
                    </span>
                    <span>
                        <daka-switch :checked="friend.evening" />
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import DakaSwitch from '../../components/switch'

export default {
    components: {
        DakaSwitch,
    },
    computed: {
        ...mapGetters({
            friends: 'notice/friends',
            first: 'notice/first',
        }),
        friendCount() {
            return this.friends.length
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~@/front/src/styles/variables.scss';

.alert{
    height: torem(60px);
    line-height: torem(60px);
    background: #f8675f;
    color: #fff;
    text-align:center;
    font-size: torem(28px);
}
.notice-head{
    display:flex;
    height: torem(120px);
    border-bottom-left-radius: torem(30px);
    border-bottom-right-radius: torem(30px);
    border-bottom: 1px solid #eee;
    background: #fff;
    justify-content: space-between;
    box-sizing: border-box;
    padding-top: torem(35px);
    padding-left: torem(40px);
    padding-right: torem(30px);

    .friend-count{
        color: #333;
        font-size: torem(32px);
        line-height: torem(50px);
        
        span{
            font-size: torem(48px);
            margin-right: torem(10px);
        }
    }
    .notice-title{
        span{
            display:inline-block;
            width: torem(130px);
            line-height: torem(50px);
            text-align:center;
            color: #333;
        }
    }
}
.friend-list{
    margin: 0 auto;
    width: torem(715px);
    padding-top: torem(20px);

    .first-row{
        display: flex;
        height: torem(130px);
        border-radius: torem(30px);
        padding: torem(30px);
        justify-content: space-between;
        background: linear-gradient(90deg, #f7eb76, #fdfdfd);
        box-sizing: border-box;
        margin-bottom: torem(35px);
        box-shadow: torem(5px) torem(5px) torem(25px) #666;

        .info{
            .h-title{
                font-size: torem(40px);
                font-weight:bold;
            }
            .tips{
                font-size: torem(26px);
                color: #666;
                margin-top: torem(5px);
            }
        }

        .notice-info{
            span{
                display:inline-block;
                width: torem(130px);
                text-align:center;
            }
        }
    }
    
    .friend-row{
        display: flex;
        height: torem(130px);
        border-radius: torem(30px);
        padding: torem(30px);
        justify-content: space-between;
        background: #fff;
        border: 1px solid #eee;
        box-shadow: torem(5px) torem(5px) torem(15px) #666;
        margin-bottom: torem(35px);
        box-sizing: border-box;

        .friend-info{
            display:flex;
            .avatar{
                width: torem(75px);
                height: torem(75px);
                border-radius: 50%;
                overflow:hidden;

                img{
                    width: 100%;
                    height: 100%;
                }
            }
            .nickname{
                height: torem(75px);
                line-height: torem(75px);
                margin-left: torem(15px);
            }
        }

        .notice-info{
            span{
                display:inline-block;
                width: torem(130px);
                text-align:center;
            }
        }
    }
}
</style>