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

        methods: {
            remove() {
                console.log('/albums/' + this.album + '/image/' + this.image.id);
                Axios.delete('/albums/' + this.album + '/image/' + this.image.id)
                    .then((response) => {
                        console.log('success');
                        this.$root.$emit('changeAlbum');
                    })
                    .catch((error) => {
                        this.error(error);
                        this.get();
                    });
            },
        }
    }
</script>
