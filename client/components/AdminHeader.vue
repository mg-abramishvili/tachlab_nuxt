<template>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3">TachLab ПУ</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="subheader w-100 px-md-4">
            {{ subheader }}
        </div>
    </header>
</template>
<script>
export default {
    data: function () {
        return {
            subheader: '_',
        };
    },
    created() {
        this.$nuxt.$on('subheader', data => {
            this.subheader = data
        })
    },
    methods: {
    },
    beforeDestroy() {
        // $off method will turn off the event listner
        this.$nuxt.$off('subheader');
    },
}
</script>