<template>
    <div class="image-uploader_body-item" :class="{'is-clicked': isClicked}" @click="clickToggle">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: {
            image: {type: Object, default: ''},
        },
        data() {
            return {
                isClicked: false
            }
        },

        methods: {
            clickToggle() {
                this.isClicked = !this.isClicked;
                this.selected();
            },

            selected() {
                if(this.isClicked) {
                    this.$emit('imageSelected', this.image.imageId)
                } else {
                    this.$emit('imageDeselected', this.image.imageId)
                }
            }

        }
    }
</script>
