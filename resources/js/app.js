import './bootstrap';

import Alpine from 'alpinejs';
import Vue from 'vue/dist/vue.js';
import VideosList from "./components/VideosList.vue";
import VideoForm from "./components/VideoForm.vue";
import casteaching from '@acacha/casteaching'
import Status from "./components/Status.vue";

<<<<<<< HEAD
window.api = casteaching({baseUrl: 'http://casteachingbayo.test/api/'})
window.api.setToken('SJOPz2ZoMnIDkUr5q4QkoEsx5cSnRRAoH2kapa5M')
=======
window.api = casteaching({baseUrl: 'https://casteachingbayo.test/api/'})
window.api.setToken('4dtQl58nAQ6ciWW04BHdQCav2WbMnspuJnHjGYrO')
>>>>>>> main


window.Alpine = Alpine;
Alpine.start();

window.Vue = Vue;


window.Vue.component('videos-list',VideosList);
window.Vue.component('video-form',VideoForm);
window.Vue.component('status',Status);


const app = new window.Vue({
    el: '#vueapp',
});
