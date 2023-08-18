<script setup>
    import CardType from '@/Pages/Pokemon/Partials/CardType.vue';

    const { types } = defineProps({
        types: {
            type: Object,
            default: null,
        },
    });

    const pokemonTypes = types.results;
</script>

<template>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Tipos de Pokémon:</h1>
                    <div class="flex flex-wrap">
                        <CardType
                            v-for="(item, index) in pokemonTypes"
                            :key="index"
                            :type="item"
                            class="inline-block w-1/4 mb-2"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
  </template>