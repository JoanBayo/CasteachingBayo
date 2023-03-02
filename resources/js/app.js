import './bootstrap';

import Alpine from 'alpinejs';
import casteaching from 'casteaching';
import Vue from 'vue/dist/vue.js';
import VideosList from "./components/VideosList.vue";
import VideoForm from "./components/VideoForm.vue";

window.Alpine = Alpine;
window.casteaching=casteaching;
Alpine.start();

window.Vue = Vue;


window.Vue.component('videos-list',VideosList);


const app = new window.Vue({
    el: '#vueapp',
});
