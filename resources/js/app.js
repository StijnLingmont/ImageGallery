import Vue from 'vue';
import Axios from 'axios';
import VueRouter from "vue-router";

//Components
import Navigation from "./components/Navigation";
import Dropdown from "./components/Dropdown";
import Popup from "./components/Popup";
import ImageUploader from './components/ImageUploader';

Vue.component('navigation', Navigation);
Vue.component('dropdown', Dropdown);
Vue.component('popup', Popup);
Vue.component('image-uploader', ImageUploader);

const app = new Vue({
    el: '#page',
    data: {
        popupFile: ''
    },
    methods: {
        showPopUp() {
            this.$emit('showPopUp');
        }
    },
});
