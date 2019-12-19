<script>
    export default {
        data() {
            return {
                isActive: false,
            }
        },
        methods: {
            show() {
                if(window.innerWidth < 480) {
                    this.$refs.form.classList.add('mobile-show-form')
                } else {
                    this.$refs.form.classList.add('show-form')
                }
            }
        }
    }
</script>
