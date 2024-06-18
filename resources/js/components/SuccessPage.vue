<template>
    <div>
        <h1>{{ page.title }}</h1>
        <img :src="getImageUrl()" alt="Image" style="max-width: 100%;">
        <p>{{ page.description }}</p>
        <p>{{ paymentStatus }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            page: {},
            paymentStatus: ''
        };
    },
    mounted() {
        this.fetchPageData();
        this.paymentStatus = 'Payment successful'; // Mocked response for payment success
    },
    methods: {
        fetchPageData() {
            axios.get('/api/pages/3') // Assuming success page has ID 3
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
