<template>
    <div class="owned-image">
        <button class="delete-image btn btn-delete" @click="remove">X</button>
        <slot></slot>
    </div>
</template>
<script>
    import Axios from 'axios';

    export default {
        props: {
            album: {type: Number, default: 0},
            image: {type: Object, default: null},
        },

        data() {
            return {
                processing: false,
            }
        },

        methods: {
            remove() {
                if(!this.processing) {
                    this.processing = true;
                    Axios.delete('/albums/' + this.album + '/image/' + this.image.id)
                        .then((response) => {
                            this.$root.$emit('changeAlbum');
                            this.processing = false
                        })
                        .catch((error) => {
                            this.error(error);
                            this.get();
                        });
                }
            },
        }
    }
</script>
