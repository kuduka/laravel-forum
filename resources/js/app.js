require('./bootstrap');

window.Vue = require('vue');

window.Vue.prototype.authorize = function (handler) {

	let user = window.App.user;

	return user ? handler(user) : false;
};

window.events = new Vue();

window.flash = function (message) {
	window.events.$emit('flash', message);
};

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('thread-view', require('./pages/Thread.vue').default);


const app = new Vue({
    el: '#app',
});
