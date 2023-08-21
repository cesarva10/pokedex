<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Carousel from '@/Pages/Pokemon/Partials/Carousel.vue';
    import CardTypeList from '@/Pages/Types/Partials/CardTypeList.vue';
    import CardPokemonList from '@/Pages/Pokemon/Partials/CardPokemonList.vue';
    import { Head } from '@inertiajs/vue3';

    defineProps({
        pokemonTypes: {
            types: Object,
            default: null
        },
        recentFavorites: {
            types: Object,
            default: null
        }
    });

</script>

<template class="bg-gradient-to-r from-cyan-500 to-blue-500">
    <Head title="Inicio" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pokedex</h2>
        </template> 

        <Carousel />

        <CardPokemonList
            :pokemons="recentFavorites" 
            :hasPagination="false"
            :title="'Favoritos recientemente: '"             
            :hasShowMore="true" 
        />

        <CardTypeList 
            :types="pokemonTypes" 
            :limit=4
            :hasShowMore="true" 
        />   
                       
    </AuthenticatedLayout>
</template>
