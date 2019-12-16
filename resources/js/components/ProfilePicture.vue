<template>
    <div>
        <div class="dashboard-head_image" :style="{ backgroundImage: 'url(' + profileImage + ')' }"></div>
        <form class="dashboard_head_image-upload" @change="submitForm" @submit.prevent="storeProfilePicture">
            <input id="image" type="file" accept="image/*">
            <button ref="submitButton" type="submit" class="is-hidden"></button>
        </form>
    </div>
</template>
<script>
    import Axios from "axios";
    export default {
        data() {
            return {
                profileImage: ""
            }
        },
        methods: {
            submitForm() {
                this.$refs.submitButton.click();
            },
            getProfilePicture() {
                Axios.get('/dashboard/profile-picture')
                    .then((response) => {
                        console.log(response.data);
                        if(response.data.profilePicture != null) {
                            this.profileImage = '/storage/' + response.data.profilePicture;
                        } else {
                            this.profileImage = "assets/img/default-avatar.svg";
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            storeProfilePicture() {
                let data = new FormData();
                let files = document.getElementById('image');
                data.append('image', files.files[0]);
                Axios.post('/dashboard/profile-picture', data)
                    .then((response) => {
                        this.getProfilePicture();
                    })
                    .catch((error) => {
                        alert(error);
                        console.log(error);
                    });
            },
        },
        created() {
            this.getProfilePicture();
        }
    }
</script>
