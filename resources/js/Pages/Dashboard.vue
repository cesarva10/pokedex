<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Carousel from '@/Components/Pokemon/Carousel.vue';
    import CardTypeList from '@/Components/Pokemon/CardTypeList.vue';
    import { Head } from '@inertiajs/vue3';

    defineProps({
        pokemonTypes: {
            types: Array,
            default: null
        },
        recentFavorites: {
            types: Object,
            default: null
        }
    });

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template> 

        <Carousel />
        <CardTypeList :types="pokemonTypes" />   
                       
    </AuthenticatedLayout>
</template>
