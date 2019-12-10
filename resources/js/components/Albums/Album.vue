<template>
    <div class="album-list">
        <img v-for="image in images" v-bind:src="'/storage/' + image.image" alt="" />
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
