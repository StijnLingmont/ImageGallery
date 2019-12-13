<template>
    <div id="fullscreen" v-show="isActive">
        <div id="fullscreen-dashboard">
            <div class="dashboard-item" @click="toggleInfo"><i class="fas fa-info-circle"></i></div>
            <div class="dashboard-item" @click="hide"><i class="fas fa-times"></i></div>
        </div>

        <div class="dashboard-info" v-show="dashboardInfo">
            <h4>Image info</h4>
            <div class="is-line"></div>
            <p v-show="imageInfo.title.length || editInfo">
                <span class="info-title">Title:</span>
                <input v-show="editInfo" class="info-edit" type="text" v-model="imageInfo.title">
                <span v-show="!editInfo" class="info-content">{{ imageInfo.title }}</span>
            </p>
            <p v-show="imageInfo.description.length || editInfo">
                <span class="info-title">Beschrijving:</span>
                <textarea rows="4" v-show="editInfo" class="info-edit" v-model="imageInfo.description" type="text"></textarea>
                <span v-show="!editInfo" class="info-content">{{ imageInfo.description }}</span>
            </p>
            <button class="btn btn-small btn-primary" @click="storePictureDetail" v-show="editInfo">Save</button>
            <span class="text-success" v-show="success">Saved!</span>
        </div>

        <div id="fullscreen-inner" :style="{ left: '-' + currentSlidePosition + '%' }">
            <div v-for="image in images">
                <img class="slide-item" v-bind:src="'/storage/' + image.image" />
            </div>
        </div>

        <div id="next-button" @click="next()" class="slider-nav"><i class="fas fa-chevron-right"></i></div>
        <div id="prev-button" @click="prev()" class="slider-nav"><i class="fas fa-chevron-left"></i></div>
    </div>
</template>

<script>
    import Axios from 'axios';
    export default {
        props: {
            editInfo: {type: Number, default: 0},
        },
        data() {
            return {
                isActive: false,
                images: {},
                currentImage: 0,
                currentSlidePosition: 0,
                dashboardInfo: false,
                success: false,
                imageInfo: {
                    title: '',
                    description: '',
                }
            }
        },

        methods: {
            show() {
                this.isActive = true;
                this.albumChange();
            },

            hide() {
                this.isActive = false;
                this.albumChange();
            },

            toggleInfo() {
                this.dashboardInfo = !this.dashboardInfo
            },

            giveCurrentPosition() {
                this.currentSlidePosition = this.currentImage * 100
            },

            next() {
                if(this.currentImage === this.images.length - 1) {
                    this.currentImage = 0;
                } else {
                    this.currentImage++;
                }
                this.albumChange();
            },

            prev() {
                if(this.currentImage === 0) {
                    this.currentImage = this.images.length - 1;
                } else {
                    this.currentImage--;
                }
                this.albumChange();
            },

            albumChange() {
                this.giveCurrentPosition();
                this.getImageInfo();
                this.success = false;
                this.dashboardInfo = false;
            },

            getImageInfo() {
                Axios.get('/albums/' + this.images[this.currentImage]['pivot']['album_id'] + '/image/' + this.images[this.currentImage]['id'])
                    .then((response) => {
                        this.imageInfo.title = response.data.images.pivot.title ? response.data.images.pivot.title : '';
                        this.imageInfo.description = response.data.images.pivot.description ? response.data.images.pivot.description : '';
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },

            storePictureDetail() {
                Axios.post('/albums/' + this.images[this.currentImage]['pivot']['album_id'] + '/image/' + this.images[this.currentImage]['id'], this.imageInfo)
                    .then((response) => {
                        if(response.data.status === 'success') {
                            this.success = true;

                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },

        created() {
            this.$root.$on('fullscreen', (data) => {
                console.log(data);
                if(data.images.length) {
                    this.images = data.images;
                }
                this.currentImage = data.clicked;

                this.show();
            });
        }
    }
</script>
