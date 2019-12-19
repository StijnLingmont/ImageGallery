<template>
    <div class="dropdown-block">
        <div @click="toggleDropdown" class="dropdown-toggle" :class="{ 'is-active': isActive }">
            <slot name="button"></slot>
        </div>
        <ul v-show="isActive" class="dropdown-menu">
            <slot></slot>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isActive: false,
            }
        },
        methods: {
            toggleDropdown(e) {
                this.isActive = !this.isActive;
                e.preventDefault();
                e.stopImmediatePropagation();
                this.outOfFocus();
            },

            clickHandler() {
                this.isActive = false;
                console.log(this.isActive);

                window.removeEventListener('click', this.clickHandler);
            },

            outOfFocus() {
                if(this.isActive) {

                    let _this = this;

                    window.addEventListener('click', this.clickHandler);
                }
            },
        },
    }
</script>
