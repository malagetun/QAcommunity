<template>
    <button
            class="btn btn-default"
            v-text="text"
            v-bind:class="{'btn-success':followed}"
            v-on:click="follow"
    ></button>
</template>

<script>
    export default {
        props:['user'],
        mounted() {
            var that = this;
            axios.get('/api/user/followers', {
                params: {
                    user: this.user
                }
            }).then(function (response) {

                that.followed  = response.data.followed

            })
        },
        data() {
            return {
                followed: false
            }
        },
        computed: {
            text() {
                return this.followed ? '已关注':'关注他'
            }
        },
        methods:{
            follow(){
                axios.post('/api/user/follow',{'user': this.user}).then((response)=>{

                    this.followed=response.data.followed
                })
            }
        }
    }
</script>
