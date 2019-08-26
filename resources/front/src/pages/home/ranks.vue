<template>
    <div class="page">
        <div class="head-container" :class="[style]">
            <div class="rank-head">
                <div class="time">
                    <div class="top">{{ myRank.time }}</div>
                    <div class="bottom">我的早起</div>
                </div>
                <div class="avatar">
                    <img :src="member.avatar" />
                </div>
                <div class="rank-index">
                    <div class="top">{{ myRank.index }}</div>
                    <div class="bottom">我的排名</div>
                </div>
            </div>
        </div>
        <div class="rank-container">
            <div class="rank-head">
                <div class="title">排名</div>
            </div>
            <div class="rank-list">
                <div class="rank-item" v-for="(rank, index) in ranks" :key="rank.id">
                    <div class="rank">{{ index + 1 }}</div>
                    <div class="avatar">
                        <img :src="rank.avatar" />
                    </div>
                    <div class="nickname">{{ rank.nickname }}</div>
                    <template v-if="rank.time > 0">
                    <div class="time">{{ rank.time === 0 ? '未打卡' : rank.time }}</div>
                    <div class="like"></div>
                    </template>
                    <template v-else>
                    <div class="unchecked">未打卡</div>
                    </template>
                </div>
            </div>
        </div>
        <home-nav :active="1" />
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import HomeNav from './components/home_nav'
export default {
    components: {
        HomeNav
    },
    computed: {
        ...mapGetters({
            style: 'app/style',
            member: 'app/member',
            ranks: 'member/ranks',
            myRank: 'member/myRank',
        })
    },
    mounted() {
        this.$store.dispatch('member/getRanks', this.style)
    }
}
</script>

<style lang="scss" scoped>
@import '~@/front/src/styles/variables.scss';
.head-container{
    .rank-head{
        margin: 0 auto;
        width: torem(500px);
        padding-top: torem(50px);
        display:flex;

        .time{
            width: torem(150px);
            text-align:center;
            .top{
                font-size: torem(54px);
                color: #333;
            }
            .bottom{
                font-size: torem(28px);
                color: #726969;
                margin-top: torem(15px);
            }
        }
        .avatar{
            width: torem(200px);
            text-align:center;
            img{
                width: torem(105px);
                height: torem(105px);
                border-radius: 50%;
            }
        }
        .rank-index{
            width: torem(150px);
            text-align:center;
            .top{
                font-size: torem(54px);
                color: #333;
            }
            .bottom{
                font-size: torem(28px);
                color: #726969;
                margin-top: torem(15px);
            }
        }
    }
}
.rank-container{
    margin: 0 auto;
    margin-top: torem(-140px);
    width: torem(680px);
    border-radius: torem(20px);
    padding: torem(15px);
    box-shadow: torem(5px) torem(20px) torem(5px) #ebebeb;
    background:#fff;

    .rank-head{
        height: torem(80px);
        line-height: torem(80px);
        margin-bottom: torem(30px);

        .title{
            padding-left: torem(20px);
            font-size: torem(40px);
            color: #333;
        }
    }

    .rank-list{
        .rank-item{
            display:flex;
            font-size: torem(32px);

            .rank{
                width: torem(50px);
                line-height:torem(75px);
                text-align:center;
            }
            .avatar{
                img{
                    width: torem(65px);
                    height: torem(65px);
                    border: 2px solid #e8e8e8;
                    border-radius: 50%;
                }
            }
            .nickname{
                line-height: torem(75px);
                width: torem(300px);
                margin-left: torem(25px);
                color:#0a0a0a;
            }
            .time{
                line-height: torem(75px);
                width: torem(135px);
                color: #4b4b4b;
            }
            .like{
                line-height: torem(75px);
            }
            .unchecked{
                line-height: torem(75px);
                width: torem(200px);
                color: #a3a3a3;
                font-size: torem(28px);
                text-align: right;
            }
        }
    }
}
</style>