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
        created() {
            this.$root.$on('isEdit', (data) => {
                this.title = data.title;
                this.privacyStatus = data.privacyStatus ? 'checked' : 0;
                this.albumId = data.id;
                this.action = '/albums' + (data.id ? '/' + data.id : '');
            });
        }
    }
</script>
