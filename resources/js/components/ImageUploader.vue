<template>
    <popup>
        <section id="image-uploader">
            <div class="image-uploader_body" ref="imageUploaderBody" @dragover.prevent="dragenter" @drop="dropImage" @dragenter="dragenter" @dragleave="dragleave">
                <uploaded-image v-for="image in images" :image="image" v-bind:key="image.imageId" @imageSelected="imageSelected($event)" @imageDeselected="imageDeselected($event)">
                    <form @change="submitForm" @submit.prevent="!progressing ? remove(image.id) : ''" method="post">
                        <button type="submit" class="remove-picture btn btn-small btn-delete"><i class="fas fa-times"></i></button>
                    </form>
                    <div class="body-item_image" :style="{ backgroundImage: 'url(/storage/' + image.image + ')' }" ></div>
                </uploaded-image>
                <div v-if="!images.length" class="image-uploader_no-images">
                    <img class="image-uploader_no-images-image" src="/images/picture.svg">
                    <h1 class="image-uploader_no-images-title">There are no images uploaded yet.</h1>
                    <h3 class="image-uploader_no-images-subtitle">Drag and drop images or click on '<i class="fas fa-file-upload"></i> Upload a file' to upload images</h3>
                </div>
            </div>

            <div class="is-line"></div>

            <div class="image-uploader_footer">
                <div class="inputWrapper">
                    <form @change="submitForm" @submit.prevent="uploadImages(0)" type="post" id="image-form" enctype="multipart/form-data">
                        <input type="file" name="image" id="image" accept="image/*" class="image-uploader" multiple />
                        <label for="image"><strong><i class="fas fa-file-upload"></i> Upload a file</strong></label>

                        <button ref="submitButton" type="submit" style="display: none"></button>
                    </form>
                </div>
                <div class="add-to-album">
                    <button class="btn btn-primary" @click="addToAlbum"><i class="fas fa-folder-plus"></i> Add to Album</button>
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
                images: [],
                progressBar: false,
                selectedImages: [],
                progressing: false,
                usedImages: [],
                removedImage: 0,
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
                        if(files.files[i].size > 10000000) {
                            uploadStatus = false;
                            this.error(files.files[i].name + ' is to large to upload. Please upload a picture under 5mb');

                        } else if(files.files[i].type !== 'image/jpeg' && files.files[i].type !== 'image/png') {
                            uploadStatus = false;
                            this.error(files.files[i].name + ' is not an validated picture. Please upload a picture under 5mb');
                        } else {
                            data.append('image' + i, files.files[i]);
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
                    }
                }
            },

            store(data, config, maxFiles, currentFilesUploaded) {
                this.progressBar = true;
                Axios.post( '/image', data, config)
                    .then((response) => {
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
                        this.images = [];
                        this.progressing = false;
                        for(let i = 0; i < response.data.images.length; i++) {
                            if(!this.usedImages.some(el => el.id === response.data.images[i].id)) {
                                this.images.push(response.data.images[i]);
                            }
                        }
                        this.$root.$emit('closePopup');
                    })
                    .catch((error) => {
                        this.progressing = false;
                        this.error(error);
                    });
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
                        this.$root.$emit('changeAlbum', true);
                        this.getUsedImages();
                    })
                    .catch((error) => {
                        this.error(error);
                    });
            },

            remove(image) {
                if(!this.progressing && this.removedImage !== image) {
                    this.progressing = true;
                    this.removedImage = image;
                    Axios.delete( '/image/' + image)
                        .then((response) => {
                            this.$root.$emit('changeAlbum', false);
                            this.get();
                            return true;
                        })
                        .catch((error) => {
                            this.error(error);
                            this.get();
                            this.progressing = false;
                            this.removedImage = image;
                            return false;
                        });
                }
            },

            error(error) {
                alert(error);
                console.log(error);
            },

            dragenter() {
                this.$refs.imageUploaderBody.classList.add('dragging');
            },

            dragleave() {
                this.$refs.imageUploaderBody.classList.remove('dragging');
            },

            dropImage(e) {
                e.preventDefault();
                document.getElementById('image').files = e.dataTransfer.files;

                this.uploadImages(0);

                this.dragleave();
            },

            getUsedImages() {
                Axios.post('/albums/' + this.albumId + '/image')
                    .then((response) => {
                        this.usedImages = response.data;
                        this.get();
                    })
                    .catch((error) => {
                        alert(error);
                    });
            },
        },

        mounted() {
            this.getUsedImages();

            this.$root.$on('getPictures', () => {
                this.getUsedImages();
            });
        }
    }
</script>
