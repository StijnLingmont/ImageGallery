<template>
    <div class="album-list">
        <img v-for="(image, key) in images" v-bind:src="'/storage/' + image.image" @click="fullScreen(key)" alt="Image" />
    </div>
</template>

<script>
    import Axios from 'axios';
    export default {
        props: {
            albumId: {type: Number, default: 0},
        },

        data() {
            return {
                images: {},
            }
        },

        methods: {
            getPictures() {
                Axios.post('/albums/' + this.albumId + '/image')
                    .then((response) => {
                        this.images = response.data;
                    })
                    .catch((error) => {
                        alert(error);
                    });
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
