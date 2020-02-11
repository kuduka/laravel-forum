require('./bootstrap');

window.Vue = require('vue');

let authorizations = require('./authorizations');

window.Vue.prototype.authorize = function (...params) {

	if (! window.App.signedIn) return false;

	    if (typeof params[0] === 'string') {
	        return authorizations[params[0]](params[1]);
	    }

	return params[0](window.App.user);
};

window.Vue.prototype.signedIn = window.App.signedIn;

window.events = new Vue();

window.flash = function (message, level = 'success') {
	window.events.$emit('flash', { message, level });
};

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('thread-view', require('./pages/Thread.vue').default);
Vue.component('user-notifications', require('./components/UserNotifications.vue').default);
Vue.component('avatar-form', require('./components/AvatarForm.vue').default);


const app = new Vue({
    el: '#app',
});
