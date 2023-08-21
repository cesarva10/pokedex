<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PokemonList from './Partials/PokemonList.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    pokemons: {
        type: Object,
        default: null
    }
});
</script>

<template>
    <Head title="Pokemones" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pokemons</h2>
        </template>

        <PokemonList 
            :pokemons="pokemons" 
            :title="'Todos los pokemones'"
            :hasPagination="true"
        />
    </AuthenticatedLayout>
</template>
