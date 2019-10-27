require('./bootstrap');

window.Vue = require('vue');

window.events = new Vue();

window.flash = function (message) {
	window.events.$emit('flash', message);
};

Vue.component('flash', require('./components/Flash.vue').default);

const app = new Vue({
    el: '#app',
});
