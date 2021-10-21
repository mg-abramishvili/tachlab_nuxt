<template>
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="header-top-tel">
                        <a>info@tachlab.ru</a>
                        <a href="tel:+78002002302">+7 800 200 23 02</a>
                    </div>
                    <div class="header-top-search">
                        <input type="text" class="form-control" placeholder="Поиск по магазину...">
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="header-bottom-logo">
                        <NuxtLink to="/">
                            <img src="http://localhost/img/logo.svg" alt="TachLab - ТачЛаб">
                        </NuxtLink>
                    </div>
                    <div class="header-bottom-nav">
                        <nav>
                            <ul class="nav">
                                <li class="nav-item">
                                    <NuxtLink :to="{ name: 'categories'}" class="nav-link">Магазин</NuxtLink>
                                </li>
                                <li class="nav-item">
                                    <NuxtLink to="/" class="nav-link">Контакты</NuxtLink>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-bottom-cart">
                        Корзина ({{ items }})
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
<script>
export default {
data: function () {
return {
items: 1,
};
},
created() {
this.$nuxt.$on('header_cart_items', data => {
this.items = data
})
},
methods: {
},
beforeDestroy() {
// $off method will turn off the event listner
this.$nuxt.$off('test');
},
}
</script>