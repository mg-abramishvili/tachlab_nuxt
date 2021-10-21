<template>
    <div class="container mt-4">
        <h1>Каталог</h1>
        <div class="row">
            <div v-for="category in categories" :key="'category_' + category.id" class="col-12 col-md-4">
            <NuxtLink :to="{ name: 'category-id', params: { id: category.id }}">{{ category.name }}</NuxtLink>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    head: {
        title: 'Каталог',
    },
    data: function () {
        return {
            categories: [],
        };
    },
    created() {
        this.$axios.get('http://localhost:80/api/categories')
        .then((response => {
            this.categories = response.data
        }));
    },
    methods: {
    },
}
</script>