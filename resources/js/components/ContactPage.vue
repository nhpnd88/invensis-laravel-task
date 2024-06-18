<template>
    <div>
        <h1>{{ page.title }}</h1>
        <img :src="getImageUrl()" alt="Image" style="max-width: 100%;">
        <p>{{ page.description }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            page: {}
        };
    },
    mounted() {
        this.fetchPageData();
    },
    methods: {
        fetchPageData() {
            axios.get('/api/pages/2') // Assuming home page has ID 1
                .then(response => {
                    this.page = response.data.page;
                })
                .catch(error => {
                    console.error('Error fetching page data', error);
                });
        },
        getImageUrl() {
            return this.page.image ? '/storage/' + this.page.image : ''; // Update path as per your storage setup
        }
    }
}
</script>
