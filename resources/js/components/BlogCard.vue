<template>
    <div class="blog-card-container">
        <div class="row justify-content-center">
            <a class="blog-card d-flex flex-column justify-content-center align-items-center" :href="'/blog/' + id">

                <div class="blog-image">
                    <img :src="image" alt="">
                </div>
                <div class="info">
                    <div class="blog-date">
                        {{ date }}
                    </div>
                    <div class="blog-title">{{ title }}</div>
                    <div class="blog-card-category-container">
                        <div v-for="category in categories" :key="category">
                            {{ category }}
                        </div>
                    </div>
                    <div class="read-more">
                        View post
                    </div>
                </div>

            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'image', 'categories', 'id', 'date'],
        mounted() {
        },
        data(){
            return {
                categories: this.categories.split(","),
            }
        },
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
    margin: 1rem;

    cursor: pointer;
}

.blog-card {
    height: 100%;
    transition: 0.5s ease all;
    text-decoration: none;
    
        &:hover {
            transform: scale(1.01);
        }
}
.blog-image {
    img {
        min-height: 150px;
        display: block;
        z-index: 1;
        width: 100%;
        -o-object-fit: cover;
        object-fit: cover;
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
.read-more {
    width: 100%;
    font-size: 0.7rem;
    text-decoration: underline;
    color: #2e86de;
}
</style>
