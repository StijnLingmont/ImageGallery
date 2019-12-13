<script>
    export default {
        data() {
            return {
                albumId: '',
                title: '',
                privacyStatus: false,
                action: '',
            }
        },
        methods: {
            status() {
                this.privacyStatus = this.$refs.checkbox.checked;
            }
        },
        created() {
            this.$root.$on('isEdit', (data) => {
                this.title = data.title;
                this.privacyStatus = data.privacyStatus ? true : false;
                this.albumId = data.id;
                this.action = '/albums' + (data.id ? '/' + data.id : '');
            });
        }
    }
</script>
