<template>
    <div class="album">
        <img>
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
                        console.log(response.data);
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
