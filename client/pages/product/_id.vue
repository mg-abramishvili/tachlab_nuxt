<template>
    <div class="container mt-4">
        <h1>{{ product.name }}</h1>

        <br/>

        {{ product.price }}

        <br/>

        {{ product.description }}
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
            title: this.product.name,
            meta: [
                { hid: 'description', name: 'description', content: this.product.description },
            ]
        }
    },
    async asyncData({ params, $axios }) {
      const product = await $axios.$get(`http://localhost:80/api/product/${params.id}`)
      return { product }
    }
  }
</script>
