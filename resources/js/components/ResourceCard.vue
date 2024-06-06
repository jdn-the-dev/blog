<template>
    <div class="resource-card-container">
        <div class="row justify-content-center">
            <div class="resource-card d-flex flex-column justify-content-center align-items-center" @click="navigate()">
                <img :src="image" alt="" width="200">
                <div class="resource-title">Title</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'image'],
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                //categories: this.categories.split(","),
            }
        },
        methods: {
            navigate() {
                window.location.href = `/resource/`;
            }
        }
    }
</script>
<style lang="scss" scoped>
.resource-card-container{
    display: flex;
    flex-wrap: wrap;
    padding-left: 0;
    justify-content: center;
    align-items: center;
    min-height: 7.5rem;
    margin: 1rem;
    flex: 0 25%;
    border: .0625rem solid #a9acaa;
    border-radius: .5rem;
    cursor: pointer;
}
.resource-card {
    height: 100%;
}
</style>
