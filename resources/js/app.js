import Vue from 'vue';
import ScrollMagic from 'scrollmagic';
import VueMasonry from 'vue-masonry-css';

//Components
import Navigation from "./components/Navigation";
import Dropdown from "./components/Dropdown";
import Popup from "./components/Popup";
import ImageUploader from './components/ImageUploader';
import ProgressBar from './components/ProgressBar';
import Image from './components/Image Uploader/Image';
import Album from './components/Albums/Album';
import AlbumForm from './components/Albums/AlbumForm';
import FullscreenImage from "./components/FullscreenImage";
import ProfilePicture from "./components/ProfilePicture";
import ChangePassword from "./components/ChangePassword";
import Fade from "./components/Albums/Fade";
import LazyImageLoad from "./components/Albums/LazyImageLoad";
import OwnedAlbumImage from "./components/Albums/OwnedAlbumImage";

Vue.use(VueMasonry);

Vue.component('navigation', Navigation);
Vue.component('fade', Fade);
Vue.component('lazy-image-check', LazyImageLoad);
Vue.component('dropdown', Dropdown);
Vue.component('popup', Popup);
Vue.component('image-uploader', ImageUploader);
Vue.component('progress-bar', ProgressBar);
Vue.component('uploaded-image', Image);
Vue.component('album', Album);
Vue.component('album-form', AlbumForm);
Vue.component('fullscreen-image', FullscreenImage);
Vue.component('ProfilePicture', ProfilePicture);
Vue.component('change-password', ChangePassword);
Vue.component('owned-image', OwnedAlbumImage);

let controller = new ScrollMagic.Controller();
let fadeIn = document.getElementsByClassName('is-fade-in');

Vue.prototype.$scrollmagic = controller; //Adding scroll magic to Vue

const app = new Vue({
    el: '#page',
    data: {
        popupFile: '',
    },
    methods: {
        showPopUp() {
            this.$emit('showPopUp');
        },

        editForm(data) {
            this.$emit('isEdit', data);
            this.showPopUp();
        }
    },
    created() {
        this.$on('changeAlbum', (closePopup) => {
            this.$emit('getPictures');
            this.$emit('deselectPicture');
            if(closePopup) {
                this.$emit('closePopUp');
            }
        });

        this.$on('loadFullScreen', (data) => {
            this.$emit('fullscreen', data);
        });

        this.$on('addImages', () => {
            this.$emit('addImagesToAlbum');
        });
    }
});

// for(var i = 0; i < fadeIn.length; i++)
// {
//     let element = new ScrollMagic.Scene({
//         triggerElement: fadeIn[i],
//         reverse: false,
//         triggerHook: 1
//     })
//         .setClassToggle(fadeIn[i], 'show')
//         .addTo(controller);
// }
