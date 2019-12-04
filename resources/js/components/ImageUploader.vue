<template>
    <popup>
        <div class="image-uploader">
            <div class="image-uploader_body"></div>
            <div class="image-uploader_footer">
                <div class="inputWrapper">
                    <form @change="uploadImages" type="post" id="image-form">
                        <input type="file" name="image" id="image" class="image-uploader" multiple />
                        <label for="image"><strong><i class="fas fa-file-upload"></i> Choose a file</strong></label>
                    </form>
                </div>
            </div>
        </div>
    </popup>
</template>

<script>
    import Axios from 'axios';
    export default {
        methods: {
            uploadImages(event) {
                let config = {
                    onUploadProgress: (progressEvent) => {
                        console.log(progressEvent);
                    }
                };

                let data = document.getElementById('image').files;
                console.log(data);

                Axios.post('/image', data, config)
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
