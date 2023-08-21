<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import PokemonList from '@/Pages/Pokemon/Partials/PokemonList.vue';

    defineProps({
        pokemons: {
            types: Object,
            default: null
        },
        typeData: {
            types: Object,
            default: null
        },
    });

</script>

<template>
    <Head title="Pokemones" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pokemones</h2>
        </template>   

        <PokemonList 
            :pokemons="pokemons"
            :hasPagination="true"
            :title="'Todos los pokemones: '" 
        />
    </AuthenticatedLayout>
</template>