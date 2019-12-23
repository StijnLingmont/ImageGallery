<script>
    import Axios from 'axios';
    export default {
        props: {
            albumId: {type: Number, default: 0},
            imageList: {type: Array},
        },

        data() {
            return {
                images: {},
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
            }
        },

        mounted() {
            this.getPictures();

            this.$root.$on('getPictures', () => {
                this.getPictures();
            });
        }
    }
</script>
