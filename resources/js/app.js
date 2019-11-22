import Vue from 'vue';
import Axios from 'axios';

//Components
import Navigation from "./components/Navigation";
import Dropdown from "./components/Dropdown";

Vue.component('navigation', Navigation);
Vue.component('dropdown', Dropdown);

const app = new Vue({
    el: '#page',
});
