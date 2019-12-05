<template>
    <div class="progress-bar" v-show="isActive">
        <div class="progress-bar_body" :style="{ width: + progress + '%'}"></div>
    </div>
</template>

<script>
    export default {
        props: {
            progress: {type: Number, default: 0},
            isActive: {type: Boolean, default: false}
        },
        methods: {
            start() {
                this.isActive = true;
            },
            stop() {
                this.isActive = false;
            }
        },
    }
</script>
