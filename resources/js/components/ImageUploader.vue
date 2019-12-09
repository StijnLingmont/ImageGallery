<template>
    <popup>
        <section id="image-uploader">
            <div class="image-uploader_body">
                <uploaded-image v-for="image in images" :image="image" v-bind:key="image.imageId" @imageSelected="imageSelected($event)" @imageDeselected="imageDeselected($event)">
                    <div class="body-item_image" :style="{ backgroundImage: 'url(/storage/' + image.image + ')' }" ></div>
                </uploaded-image>
            </div>

            <div class="is-line"></div>

            <div class="image-uploader_footer">
                <div class="inputWrapper">
                    <form @change="submitForm" @submit.prevent="uploadImages(0)" type="post" id="image-form" enctype="multipart/form-data">
                        <input type="file" name="image" id="image" class="image-uploader" multiple />
                        <label for="image"><strong><i class="fas fa-file-upload"></i> Choose a file</strong></label>

                        <button ref="submitButton" type="submit" style="display: none"></button>
                    </form>
                </div>
                <div class="add-to-album">
                    <button class="btn btn-primary" @click="addToAlbum"><i class="fas fa-folder-plus"></i> Voeg toe</button>
                </div>
            </div>
        </section>

        <progress-bar :is-active="progressBar" :progress="progressUpload"></progress-bar>
    </popup>
</template>

<script>
    import Axios from 'axios';

    export default {
        props: {
            albumId: {type: Number, default: 0},
        },

        data() {
            return {
                progressUpload: 0,
                images: {},
                progressBar: false,
                selectedImages: [],
            }
        },

        methods: {
            submitForm() {
                this.$refs.submitButton.click();
            },

            uploadImages(uploadedFiles) {
                let files = document.getElementById('image');
                let config = this.storeConfig();
                let maxFiles = files.files.length;
                let filesARequest = 4;
                let uploadStatus = true;

                this.progressUpload = 0;

                let data = new FormData();

                for(let i = uploadedFiles; i < uploadedFiles + filesARequest; i++) {
                    if(files.files[i] !== undefined) {
                        if(files.files[i].size < 5000000) {
                            data.append('image' + i, files.files[i]);
                        } else {
                            uploadStatus = false;
                            this.error(files.files[i].name + 'is to large to upload. Please upload a picture under 5mb');
                        }
                    }
                }
                if(uploadStatus) {
                    this.store(data, config, maxFiles, uploadedFiles);
                }
            },

            storeConfig() {
                return {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },

                    onUploadProgress: (progressEvent) => {
                        let total = progressEvent.total;
                        let loaded = progressEvent.loaded;

                        let progress = Math.round(100 / total * loaded);

                        this.progressUpload = progress;
                        console.log(progress);
                    }
                }
            },

            store(data, config, maxFiles, currentFilesUploaded) {
                this.progressBar = true;
                Axios.post( '/image', data, config)
                    .then((response) => {
                        console.log(response.data);
                        let amountAfterUploading = currentFilesUploaded + response.data.amount;
                        if(amountAfterUploading < maxFiles) {
                            //Do another round
                            this.progressUpload = 0;
                            this.uploadImages(amountAfterUploading);
                            this.get();
                        } else {
                             //Upload is finished
                            this.get();
                            this.progressBar = false;
                            this.progressUpload = 0;
                            return true;
                        }
                    })
                    .catch((error) => {
                        this.error(error);
                        this.get();
                        this.progressBar = false;
                        return false;
                    });
            },

            get() {
                Axios.post( '/image/all')
                    .then((response) => {
                        this.images = response.data.images;
                    })
                    .catch((error) => {
                        this.error(error);
                    });
            },

            error(error) {
                alert(error);
                console.log(error);
            },

            imageSelected(image) {
                let imageList = this.selectedImages;
                if(!imageList.includes(image)) {
                    imageList.push(image);
                    this.selectedImages = imageList;
                }
            },

            imageDeselected(image) {
                let imageList = this.selectedImages;
                let index = imageList.indexOf(image);
                if(imageList.includes(image)) {
                    imageList.splice(index, 1);
                    this.selectedImages = imageList;
                }
            },

            addToAlbum() {
                Axios.post( '/albums/' + this.albumId +  '/image/add', this.selectedImages)
                    .then((response) => {
                        console.log(response.data);
                        this.$root.$emit('picturesAddToAlbum');
                    })
                    .catch((error) => {
                        this.error(error);
                    });
            }
        },

        created() {
            this.get();
        }
    }
</script>
