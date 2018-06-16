<template>
    <div>
       <div style="text-align: center">
           <img style="width: 120px;margin: 0 auto;" class="media-object"  :src="this.url" />

            <vue-core-image-upload
                    class="btn btn-primary"
                    :crop="true"
                    @imageuploaded="imageuploaded"
                    :data="data"
                    :max-file-size="5242880"
                    url="/avatar"
                    text="上传头像"
                    style="margin-top: 20px"
            >
            </vue-core-image-upload>
        </div>

    </div>
</template>

<script>
    import VueCoreImageUpload from '../../../../node_modules/vue-core-image-upload/dist/vue-core-image-upload.vue'

    export default {
        props:['avatar'],
        components: {
            'vue-core-image-upload': VueCoreImageUpload,
            url:this.avatar
        },

        data() {
            return {
                url: this.avatar,
            }
        },
        methods: {
            imageuploaded(res) {
//                if (res.errcode == 0) {
//                    this.src = res.data.src;
//                }
                this.url = res.url;
            }
        }
    };
</script>
