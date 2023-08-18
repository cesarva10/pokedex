<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import General from './Partials/General.vue';
    import Moves from './Partials/Moves.vue';
    import HeldItems from './Partials/HeldItems.vue';
    import Stats from './Partials/Stats.vue';
    import ToastFavorite from './Partials/ToastFavorite.vue';
    import ToastNotFavorite from './Partials/ToastNotFavorite.vue';

    defineProps({
        pokemon: {
            types: Object,
            default: null
        },
        favorite: {
            types: Object,
            default: null
        }
    });

</script>

<template>
    <Head title="Pokemon" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pokemon</h2>
        </template>   
        
        <ToastFavorite v-if="favorite !== null" :id="pokemon.id" />
        <ToastNotFavorite v-else :id="pokemon.id" />
        
        <General 
            :id="pokemon.id"
            :name="pokemon.name" 
            :height="pokemon.height" 
            :weight="pokemon.weight" 
            :type="pokemon.types[0].type.name" 
            :baseExperience="pokemon.base_experience" 
            :imageUrl="pokemon.sprites.other.dream_world.front_default"
            :abilities="pokemon.abilities"
        />
        
        <Stats :stats="pokemon.stats" />

        <Moves :moves="pokemon.moves" />

        <HeldItems :held_items="pokemon.held_items" />

    </AuthenticatedLayout>
</template>