<template>
    <div class="container">
        <a @click="login()">Login</a>

        <NuxtLink to="/">Home Page</NuxtLink>
    </div>
</template>

<script>
export default {
    head: {
        title: 'Авторизация',
    },
    data: function () {
        return {
            name: '',
        };
    },
    created() {
        /*axios
        .get('/api/addresses')
        .then((response => {
            this.ymap_addresses = response.data
            this.ymap_cityChange()
        }));*/
    },
    methods: {
        login() {
            this.$auth.loginWith('laravelSanctum', {
                data: {
                    email: 'mg@abramishvili.net',
                    password: '63VBtbjw'
                }
            })
            .then(() => 
                this.$router.push({path: '/'})
            )
        },
    }
}
</script>
