<template>
    <div class="my-mind-outside-container">
        <div class="grid-item-my-mind">
            <img :src="img" alt="Image" :style="{ maxHeight: '450px',height: 'fit-content', objectFit: 'cover', width:'100%'}"
                @click="openModal(img)">
        </div>
    </div>
</template>

<script>
export default {
    props: ['img'],
    mounted() {

    },
    data() {
        return {
            //categories: this.categories.split(","),
        }
    },
    methods: {
        openModal(imageSrc) {
            var modal = document.getElementById("lightboxModal");
            var modalImg = document.getElementById("lightboxImage");
            if (modal && modalImg) { 
                modal.style.display = "block";
                modalImg.src = imageSrc;
            }

        },
        closeModal(event) {
                var modal = document.getElementById("lightboxModal");
                if ((event.target === modal || event.target.className === 'close') && modal) {
                    modal.style.display = "none";
                }
        }
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
    .my-mind-outside-container {
        display: flex;
        justify-content: center;
    }
    .grid-item-my-mind{
        max-height: 450px;
        width: 150px;
    }
}
</style>