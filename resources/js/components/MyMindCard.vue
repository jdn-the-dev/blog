<template>
    <div>
        <div class="grid-item-my-mind">
            <img :src="img" alt="Image" :style="{ maxHeight: '450px',height: 'fit-content', objectFit: 'cover'}"
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
/* Grid and Modal styles */
.grid-my-mind {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 10px;
}

.grid-item-my-mind img {
    width: 100%;
    cursor: pointer;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.9);
}

.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

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
}

@media (max-width: 480px) {
    .modal-content {
        width: 95%;
    }

    .close {
        font-size: 25px;
        right: 20px;
        top: 5px;
    }
}
</style>