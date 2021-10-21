<template>
    <div class="container mt-4">
        <div class="row">
            <div v-if="$auth.loggedIn">Вы успешно вошли ;)</div>
            <div v-else class="col-12 col-md-6 offset-3">
                <label class="form-label">Логин</label>
                <input v-model="email" type="email" class="form-control mb-4" placeholder="Логин">
                
                <label class="form-label">Пароль</label>
                <input v-model="password" type="password" class="form-control mb-4" placeholder="Пароль">
                <button @click="login()" class="btn btn-standard">Войти</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    layout: 'AdminLayout',
    head: {
        title: 'Авторизация',
    },
    data: function () {
        return {
            email: '',
            password: '',
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
                    email: this.email,
                    password: this.password
                }
            })
            .then(() => 
                this.$router.push({path: '/'})
            )
        },
    }
}
</script>
