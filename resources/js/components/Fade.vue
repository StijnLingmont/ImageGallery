<template>
    <div class="fade" ref="fadeBlock">
        <slot></slot>
    </div>
</template>

<script>
    import ScrollMagic from 'scrollmagic';

    export default {
        name: "Fade",
        data() {
            return {
                scene: null
            }
        },
        mounted() {
            this.scene = new ScrollMagic.Scene({
                triggerElement: this.$el,
                triggerHook: 1
            })
                .setClassToggle(this.$el, 'is-active')
                .addTo(this.$scrollmagic);

            this.$root.$on('fadeIn', () => {
                // this.$refs.fadeBlock.classList.add('is-active');
            });
        },
        beforeDestroy() {
            this.scene.destroy(true);
        }
    }
</script>

<style scoped>
    .fade {
        opacity: 0;
        transform: translateY(30px);
        transition: all 500ms ease-out;
    }
    .fade.is-active {
        opacity: 1;
        transform: translateY(0);
    }
</style>
