<template>
    <div class="admin_panel bg-light" style="min-height: 100vh;">

        <AdminHeader v-if="$auth.loggedIn"/>

        <div v-if="$auth.loggedIn" class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <NuxtLink :to="{name: 'admin'}" class="nav-link">Главная</NuxtLink>
                            </li>
                            <li class="nav-item">
                                <NuxtLink :to="{name: 'admin-products'}" class="nav-link">Каталог</NuxtLink>
                            </li>
                        </ul>

                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <NuxtLink to="/" class="nav-link">Выйти</NuxtLink>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                        <Nuxt />
                    </div>
                </main>
            </div>
        </div>

        <div v-else class="container pt-4">
            <div class="row">
                <div class="col-12 col-md-6 offset-3">
                    <label class="form-label">Логин</label>
                    <input v-model="email" type="email" class="form-control mb-4" placeholder="Логин">
                    
                    <label class="form-label">Пароль</label>
                    <input v-model="password" type="password" class="form-control mb-4" placeholder="Пароль">
                    <button @click="login()" class="btn btn-standard">Войти</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
        };
    },
    created() {       
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
                window.location.href ='/admin/products'
            )
        },
    },
}
</script>