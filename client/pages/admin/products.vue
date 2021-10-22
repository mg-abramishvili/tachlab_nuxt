<template>
    <div class="w-100">
        <h1>Каталог</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Категория</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="'product_' + product.id">
                    <td>
                        {{ product.name }}
                    </td>
                    <td>
                        <template v-for="category in product.categories">
                            {{ category.name }}
                        </template>
                    </td>
                    <td class="text-end">
                        <NuxtLink :to="{name: 'admin-product-id', params: {id: product.id}}" class="btn btn-sm btn-outline-primary">Правка</NuxtLink>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    layout: 'AdminLayout',
    head: {
        title: 'ПУ - Каталог',
    },
    data: function () {
        return {
            products: [],
        };
    },
    created() {
        this.$axios.get('http://localhost:80/api/admin/products')
        .then((response => {
            this.products = response.data
        }));
        this.$nuxt.$emit('subheader', 'Каталог');
    },
    methods: {
    },
}
</script>