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
            toggleDropdown() {
                this.isActive = !this.isActive;
            }
        },
    }
</script>
