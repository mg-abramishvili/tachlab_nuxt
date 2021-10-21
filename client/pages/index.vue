<template>
    <div>
        <div class="home-carousel">
            <div class="container">
                <div class="home-carousel-inner">
                    <h1>Сенсорные киоски <br/>и мониторы</h1>
                    <button class="btn btn-standard">В каталог</button>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div v-for="product in products" :key="'product_' + product.id" class="col-12 col-md-4 border mb-4">
                <NuxtLink :to="{ name: 'product-id', params: { id: product.id }}">{{ product.name }}</NuxtLink>
                <br/>
                {{ product.price }} руб.
                <button @click="addToCart(product.id)" class="btn btn-sm btn-outline-primary">Добавить в корзину</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    head: {
        title: 'ТачЛаб',
    },
    data: function () {
        return {
            products: [],
        };
    },
    created() {
        this.$axios.get('http://localhost:80/api/products')
        .then((response => {
            this.products = response.data
        }));
    },
    methods: {
        addToCart(id) {
            this.$nuxt.$emit('header_cart_items', id);
        }
    },
}
</script>