<template>
    <div id="lazy-loading" ref="lazyLoading" @click="action">Are the images not loading? Click then here!</div>
</template>

<script>
    import ScrollMagic from 'scrollmagic';

    export default {
        data() {
            return {
                scene: null,
            }
        },
        methods: {
            makeScrollMagic() {
                this.scene = new ScrollMagic.Scene({
                    triggerElement: this.$el,
                    triggerHook: 1
                })
                    .on("enter", (e) => {
                        this.action();
                    })
                    .addTo(this.$scrollmagic);
            },

            action() {
                this.$root.$emit('addImages');
            }
        },
        mounted() {
            this.makeScrollMagic();
        },
        beforeDestroy() {
            this.scene.destroy(true);
        }
    }
</script>

<style>
    #lazy-loading {
        text-align: center;
        cursor: pointer;
        margin-top: 3rem;
        width: 100%;
    }
</style>
