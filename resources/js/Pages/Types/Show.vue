<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import CardPokemonList from '@/Pages/Pokemon/Partials/CardPokemonList.vue';

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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pokemones de tipo: {{ typeData.name }}</h2>
        </template>   

        <CardPokemonList 
            :pokemons="pokemons" 
            :limit="Object.keys(pokemons).length" 
            :hasPagination="true"
            :title="'Todos los pokemones: '" 
        />
    </AuthenticatedLayout>
</template>