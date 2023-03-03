import './bootstrap';

import Alpine from 'alpinejs';
import Vue from 'vue/dist/vue.js';
import VideosList from "./components/VideosList.vue";
import VideoForm from "./components/VideoForm.vue";
import casteaching from '@acacha/casteaching'

window.api = casteaching({baseUrl: 'http://casteachingbayo.test/api/'})
window.api.setToken('4dtQl58nAQ6ciWW04BHdQCav2WbMnspuJnHjGYrO')


window.Alpine = Alpine;
Alpine.start();

window.Vue = Vue;


window.Vue.component('videos-list',VideosList);
window.Vue.component('video-form',VideoForm);


const app = new window.Vue({
    el: '#vueapp',
});
