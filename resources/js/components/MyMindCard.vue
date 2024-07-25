<template>
    <div class="grid-item-my-mind">
        <img :src="img" alt="Image" :style="{ maxHeight: '450px', width:'100%'}"
            @click="openModal(img, date)">
    </div>
</template>

<script>
export default {
    props: ['img', 'date'],
    mounted() {

    },
    data() {
        return {
            //categories: this.categories.split(","),
        }
    },
    methods: {
        openModal(imageSrc, date) {
            var modal = document.getElementById("lightboxModal");
            var modalImg = document.getElementById("lightboxImage");
            let modalImgDate = document.getElementById("lightbox-modal-date");
            if (modal && modalImg) { 
                modal.style.display = "block";
                modalImg.src = imageSrc;
                modalImgDate.innerText = date;
            }

        },
    }
}
</script>

<style scoped>
/* Media queries for responsive design */
@media (max-width: 768px) {
    .modal-content {
        width: 90%;
    }

    .close {
        font-size: 30px;
        right: 25px;
        top: 10px;
    }
    .grid-item-my-mind{
        max-height: 450px;
    }
}
</style>