<template>
    <div id="lazy-loading"></div>
</template>

<script>
    import ScrollMagic from 'scrollmagic';

    export default {
        data() {
            return {
                scene: null,
            }
        },
        mounted() {
            this.scene = new ScrollMagic.Scene({
                triggerElement: this.$el,
                triggerHook: 1
            })
                .on("enter", (e) => {
                    this.$root.$emit('addImages');
                })
                .addTo(this.$scrollmagic);
        },
        beforeDestroy() {
            this.scene.destroy(true);
        }
    }
</script>

<style>
    #lazy-loading {
        margin-top: 3rem;
        height: 1px;
        width: 100%;
    }
</style>
