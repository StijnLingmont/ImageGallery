<script>
    import Axios from 'axios';
    import Masonry from 'masonry-layout/dist/masonry.pkgd.min';

    export default {
        props: {
            albumId: {type: Number, default: 0},
            imageList: {type: Array},
        },

        computed: {
            limitedImages(){
                console.log(this.images.slice(0, this.loadedImages));
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
                this.loadedImages = (this.loadedImages + 10 > this.images.length ? this.images.length : this.loadedImages + 10);
            }
        },

        mounted() {
            this.getPictures();

            console.log(this.$refs.album);
            var msnry = new Masonry(this.$refs.album, {
                itemSelector: '.fade',
                columnWidth: 500
            });

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
