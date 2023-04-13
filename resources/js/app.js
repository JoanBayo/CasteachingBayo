import './bootstrap';

import Alpine from 'alpinejs';
import Vue from 'vue/dist/vue.js';
import VideosList from "./components/VideosList.vue";
import VideoForm from "./components/VideoForm.vue";
import casteaching from '@acacha/casteaching'
import Status from "./components/Status.vue";

window.api = casteaching({baseUrl: import.meta.env.VITE_API_URL})
window.api.setToken('4dtQl58nAQ6ciWW04BHdQCav2WbMnspuJnHjGYrO')


window.Alpine = Alpine;
Alpine.start();

window.Vue = Vue;


const vueApp = document.querySelector('#app')

if(vueApp){
    window.Vue = Vue
    window.Vue.component('videos-list', VideosList )
    window.Vue.component('video-form', VideoForm )
    window.Vue.component('status', Status )

    const app = new window.Vue({
        el: '#app',
    });
}

