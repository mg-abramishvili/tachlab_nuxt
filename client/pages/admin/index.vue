<template>
    <div class="w-100">
        <h1>Привет, {{ $auth.user.name }}</h1>
    </div>
</template>

<script>
export default {
    layout: 'AdminLayout',
    head: {
        title: 'Панель управления',
    },
    data: function () {
        return {
        };
    },
    created() {
        this.$nuxt.$emit('subheader', 'Панель управления');
    },
    methods: {
    }
}
</script>