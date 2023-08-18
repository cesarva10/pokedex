<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Carousel from '@/Pages/Pokemon/Partials/Carousel.vue';
    import CardTypeList from '@/Pages/Pokemon/Partials/CardTypeList.vue';
    import CardFavoriteList from '@/Pages/Pokemon/Partials/CardFavoriteList.vue';
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
    <Head title="Inicio" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pokedex</h2>
        </template> 

        <Carousel />

        <CardFavoriteList :favorites="recentFavorites" :limit=4 />

        <CardTypeList :types="pokemonTypes" />   
                       
    </AuthenticatedLayout>
</template>
