<template>
    <div class="w-100">
        <h1 class="mt-0 mb-4">{{ product.name }}</h1>

        <div class="row">
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Название</label>
                            <input v-model="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Категория</label>
                        <select v-model="category" class="form-select">
                            <option v-for="category in categories" :key="'category_' + category.id" :value="category.id">{{ category.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Цена</label>
                    <input v-model="price" type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Описание</label>
                    <textarea v-model="description" class="form-control"></textarea>
                </div>

                <div class="bg-white p-4 mb-3 border rounded">        
                    <div class="mb-3">
                        <label class="form-label">META Title</label>
                        <input v-model="meta_title" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">META Description</label>
                        <input v-model="meta_description" type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">META Keywords</label>
                        <input v-model="meta_keywords" type="text" class="form-control">
                    </div>
                </div>

                <button v-if="updateProductButton" @click="updateProduct(product.id)" class="btn btn-standard">Сохранить</button>
            </div>
            <div class="col-12 col-md-4">
                <file-pond
                    name="gallery[]"
                    ref="gallery"
                    label-idle="Выбрать картинки..."
                    v-bind:allow-multiple="true"
                    v-bind:allow-reorder="true"
                    accepted-file-types="image/jpeg, image/png"
                    :server="server"
                    v-bind:files="filepond_files_edit"
                />
            </div>
        </div>
    </div>
</template>

<script>
import vueFilePond from "vue-filepond";

import "filepond/dist/filepond.min.css";

import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

export default {
    layout: 'AdminLayout',
    data() {
        return {
            gallery: [],

            updateProductButton: true,
            
            filepond_files: [],
            server: {
                remove(filename, load) {
                    load('1');
                },
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    const formData = new FormData();
                    formData.append(fieldName, file, file.name);
                    const request = new XMLHttpRequest();
                    request.open('POST', 'http://localhost/api/admin/products/file/upload');
                    request.upload.onprogress = (e) => {
                        progress(e.lengthComputable, e.loaded, e.total);
                    };
                    request.onload = function() {
                        if (request.status >= 200 && request.status < 300) {
                            load(request.responseText);
                        }
                        else {
                            error('oh no');
                        }
                    };
                    request.send(formData);
                    return {
                        abort: () => {
                            request.abort();
                            abort();
                        }
                    };
                },
                revert: (filename, load) => {
                    load(filename)
                },
                load: (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request('http://localhost' + source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(myBlob) {
                            load(myBlob)
                        });
                    });
                },
            },
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
    created() {
        this.$nuxt.$emit('subheader', this.product.name);
    },
    methods: {
        updateProduct(id) {
            this.updateProductButton = false
            this.gallery = []
            document.getElementsByName("gallery[]").forEach((galleryItem) => {
                if(galleryItem.value) {
                    this.gallery.push(galleryItem.value)
                }
            });
            console.log(this.gallery)
            if(this.name && this.price && this.category) {
                this.updateProductButton = false
                this.$axios
                .post(`http://localhost/api/admin/product/${id}`, { name: this.name, price: this.price, description: this.description, gallery: this.gallery })
                .then(response => (
                    //console.log(response)
                    this.$router.push({name: 'admin-products'}),
                    this.updateProductButton = true
                ))
                .catch((error) => {
                    if(error.response) {
                        for(var key in error.response.data.errors){
                            console.log(key)
                            alert(key)
                        }
                    }
                });
            } else {
                alert('Заполните поля')
            }
        }
    },
    async asyncData({ params, $axios }) {
        const product = await $axios.$get(`http://localhost:80/api/admin/product/${params.id}`)
        const categories = await $axios.$get(`http://localhost:80/api/admin/categories`)
        return {
            product: product,
            name: product.name,
            description: product.description,
            price: product.price,
            meta_title: product.meta_title,
            meta_description: product.meta_description,
            meta_keywords: product.meta_keywords,
            categories: categories,
            category: product.categories[0].id,

            filepond_files_edit: product.gallery.map(function(element){
                {
                    return {
                        source: element,
                        options: {
                            type: 'local',
                        }
                    } 
                }
            })
        }
    },
    components: {
        FilePond,
    }
}
</script>
