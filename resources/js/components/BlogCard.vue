<template>
    <div class="blog-card-container">
        <div class="row justify-content-center">
            <div class="blog-card d-flex flex-column justify-content-center align-items-center" @click="navigate(id)">

                <div class="blog-image">
                    <img :src="image" alt="">
                </div>
                <div class="info">
                    <div class="blog-date">
                        {{ date }}
                    </div>
                    <div class="blog-title">{{ title }}</div>
                    <div class="blog-card-category-container">
                        <div v-for="category in categories">
                            {{ category }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'image', 'categories', 'id', 'date'],
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                categories: this.categories.split(","),
            }
        },
        methods: {
            navigate(id) {
                window.location.href = `/blog/${id}`;
            }
        }
    }
</script>
<style lang="scss" scoped>
.blog-title {
    font-weight: 700;
        font-size: 12px;
}
.blog-date {
        font-size: .65rem;
}
.info {
    display: flex;
        flex-direction: column;
        z-index: 3;
        padding: 16px 16px;
        color: #000;
        text-align: center;
}
.blog-card-container{
    display: flex;
    flex-wrap: wrap;
    padding-left: 0;
    justify-content: center;
    align-items: center;
    height: 300px;
    margin: 1rem;

    cursor: pointer;
}

.blog-card {
    height: 100%;
}
.blog-image {
    height: 200px;
    img {
        height: 100%;
    }
}
.blog-card-category-container{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: row;
    div {
        background-color: #95a5a6;
        margin: 2px;
        font-size: 12px;
        color: #fff;
        border-radius: 5px;
        padding-left: 5px;
        padding-right: 5px;
    }
}
</style>
