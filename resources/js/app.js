require('./bootstrap');

import Vue from 'vue/dist/vue.js'
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

new Vue({
    el: '#app',
    data: {
        showLoading: false,
        userUrl: null,
        userRepository: {
            site_name: null,
            url: null,
            image: null,
            locale: null
        },
        repositories: [],
        fields: [
            {key: 'site_name', sortable: true},
            {key: 'url', sortable: false},
            {key: 'image', sortable: false},
            {key: 'locale', sortable: true},
            {key: 'created_at', sortable: true},
            {key: 'updated_at', sortable: true},
            {key: 'action', sortable: false},
        ],
        perPage: 10,
        currentPage: 1,
    },
    computed: {
        rows() {
            return this.repositories.length
        }
    },
    methods: {
        getPreview: function () {
            this.showLoading = true;
            axios.post('/api/fetch', {
                url: this.userUrl
            }).then(response => {
                this.userRepository = response.data;
                this.showLoading = false;
            }).catch(error => {
                alert(error);
                this.showLoading = false;
            })
        },

        storeRepository: function () {
            axios.post('/api/repositories', this.userRepository)
                .then(response => {
                    alert('Repository stored successfully');
                    // Empty user repo object
                    Object.keys(this.userRepository).forEach(k => this.userRepository[k] = null)
                }).catch(error => {
                alert(error);
            })
        },

        getRepositories: function () {
            axios.get('/api/repositories')
                .then(response => {
                    this.repositories = response.data
                }).catch(error => {
                alert(error);
            })
        },

        removeRepository: function (id, index) {
            axios.delete('/api/repositories/' + id)
                .then(response => {
                    alert('Item deleted from repository');
                    this.repositories.splice(index, 1)
                }).catch(error => {
                alert(error);
            })
        }
    },
    mounted: function () {
        this.getRepositories()
    }
})
