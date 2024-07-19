<template>
    <div class="resource-card-container">
        <div class="row justify-content-center w-100">
            <div class="resource-card d-flex flex-column justify-content-center align-items-center"
                @click="navigate(resource)">
                <span class="material-symbols-outlined resource-icon">
                    {{icon}}
                </span>
                <div class="resource-title">{{title}}</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'icon', 'resource'],
        mounted() {

        },
        data(){
            return {
                //categories: this.categories.split(","),
            }
        },
        methods: {
            navigate(resourceName) {
                console.log(resourceName)
                window.location.href = `/resource/${resourceName}`;
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
    .resource-icon {
        font-size: 4rem;
        padding-top: 1rem;
    }
    .resource-title {
        text-align: center;
        padding: 1rem;
    }
}

</style>
