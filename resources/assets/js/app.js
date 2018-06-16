
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('question-follow-button', require('./components/QuestionFollowButton.vue'));
Vue.component('user-follow-button', require('./components/UserFollowButton.vue'));
Vue.component('user-vote-button', require('./components/UserVoteButton.vue'));
Vue.component('send-message', require('./components/SendMessage.vue'));
Vue.component('comments', require('./components/Comments.vue'));
Vue.component('user-avatar', require('./components/Avatar.vue'));
const app = new Vue({
    el: '#app'
});

$('#top-search-input').bind('keypress',function(event){
    if(event.keyCode == "13")
    {
        var curWwwPath=window.document.location.href;
        var pathName=window.document.location.pathname;
        var pos=curWwwPath.indexOf(pathName);
        var localhostPaht=curWwwPath.substring(0,pos);
        window.location.href=localhostPaht+"/search/"+$('#top-search-input').val();
    }

});
