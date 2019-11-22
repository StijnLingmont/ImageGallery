<script>
    export default {
        props: {
            transparent: {type: Number, default: false},
        },
        data() {
            return {
                headerColor: false,
            }
        },
        methods: {
            scrollCheck() {
                this.headerColor = window.pageYOffset <= 100;
            }
        },
        created() {
            this.headerColor = this.transparent;
            if(this.headerColor) {
                window.addEventListener("scroll", this.scrollCheck);
            }
        },
    }
</script>
