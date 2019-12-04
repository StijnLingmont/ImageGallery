<template>
    <div class="popup" v-show="isVisible">
        <div class="popup-hide" @click="hide"></div>
        <div class="popup-content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isVisible: false,
            }
        },
        methods: {
            show() {
                this.isVisible = true
            },

            hide() {
                this.isVisible = false;
            }
        },
        mounted() {
            this.$root.$on('showPopUp', () => {
                this.show();
            });

            if(document.getElementsByClassName('text-error').length) {
                this.show()
            }
        }
    }
</script>
