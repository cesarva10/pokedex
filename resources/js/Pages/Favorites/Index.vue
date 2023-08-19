<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FavoriteList from './Partials/FavoriteList.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    favoritesData: {
        type: Array,
        default: null
    }
});
</script>

<template>
    <Head title="Favorites" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pokemons favoritos</h2>
        </template>

        <FavoriteList :favoritesData="favoritesData" />
    </AuthenticatedLayout>
</template>
