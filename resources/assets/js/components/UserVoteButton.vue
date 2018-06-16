<template>
    <button
            class="btn btn-default"
            v-text="text"
            v-bind:class="{'btn-primary':voted}"
            v-on:click="vote"
    ></button>
</template>

<script>
    export default {
        props:['answer','count'],
        mounted() {
            var that = this;
            axios.post('/api/answer/'+this.answer+'/votes/users', {
                params: {
                    user: this.user
                }
            }).then(function (response) {

                that.voted  = response.data.voted

            })
        },
        data() {
            return {
                voted: false
            }
        },
        computed: {
            text() {
                return this.count
            }
        },
        methods:{
            vote(){
                axios.post('/api/answer/vote',{'answer': this.answer}).then((response)=>{

                    this.voted=response.data.voted
                    response.data.voted?this.count++:this.count--
                })
            }
        }
    }
</script>
