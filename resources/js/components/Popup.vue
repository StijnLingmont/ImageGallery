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
        props: {
            customInclude: {type: String, default: ''},
        },

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

            this.$root.$on('closePopUp', () => {
                this.hide();
            });

            if(document.getElementsByClassName('text-error').length) {
                this.show()
            }
        }
    }
</script>
