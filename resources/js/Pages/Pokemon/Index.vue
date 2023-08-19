<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CardPokemonList from './Partials/CardPokemonList.vue';
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

        <CardPokemonList :pokemons="pokemons" :limit="Object.keys(pokemons).length" />
    </AuthenticatedLayout>
</template>
