<template>
    <div class="container">
        <h1>{{ category.name }}</h1>

        <div class="row">
            <div v-for="product in products" :key="'product_' + product.id" class="col-12 col-md-4">
                <NuxtLink :to="{name: 'product-id', params: {id: product.id}}">
                    {{ product.name }}
                    <br/>
                    {{ product.price }} руб.
                </NuxtLink>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
        }
    },
    head() {
        return {
            title: this.category.name,
            meta: [
                { hid: 'description', name: 'description', content: this.category.name },
            ]
        }
    },
    async asyncData({ params, $axios }) {
        const category = await $axios.$get(`http://localhost:80/api/category/${params.id}`)
        const products = await $axios.$get(`http://localhost:80/api/category/${params.id}/products`)
        return { category: category, products: products }
    },
}
</script>