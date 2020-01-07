<script>
    import Axios from 'axios';

    export default {
        props: {
            albumId: {type: Number, default: 0},
            imageList: {type: Array},
        },

        computed: {
            limitedImages(){
                return this.images.slice(0, this.loadedImages);
            }
        },

        data() {
            return {
                images: [],
                loadedImages: 0,
            }
        },

        methods: {
            getPictures() {
                this.loadedImages = 0;
                if(this.imageList) {
                    this.images = this.imageList;
                } else {
                    Axios.post('/albums/' + this.albumId + '/image')
                        .then((response) => {
                            this.images = response.data;
                            if(!this.loadedImages) {
                                this.addImagesToLoaded();
                            }
                        })
                        .catch((error) => {
                            alert(error);
                        });
                }
            },

            fullScreen(clickedImage) {
                let fullscreenData = {
                    'clicked': clickedImage,
                    'images': this.images,
                };
                this.$root.$emit('loadFullScreen', fullscreenData);
            },

            addImagesToLoaded() {
                if(this.loadedImages <= 0) {
                    this.loadedImages = 15;
                } else {
                    this.loadedImages = (this.loadedImages + 10 > this.images.length ? this.images.length : this.loadedImages + 10);
                }
                this.checkIfEnd();
            },

            checkIfEnd() {
                if(this.loadedImages >= this.images.length) {
                    document.getElementById('lazy-loading').innerText = '';
                }
            }
        },

        mounted() {
            this.getPictures();

            this.$root.$on('getPictures', () => {
                this.getPictures();
            });

            this.$root.$on('addImagesToAlbum', () => {
                if(this.images.length) {
                    this.addImagesToLoaded();
                }
            });
        },

    }
</script>
