<script setup>
    import CardType from '@/Pages/Types/Partials/CardType.vue';

    const { types, limit } = defineProps({
        types: {
            type: Object,
            default: null,
        },
        limit: {
            type: Number,
            default: 100,
        }
    });

    const pokemonTypes = types.results;
</script>

<template>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-extrabold dark:text-white mb-4">Tipos de pokemón: </h2>
                    <div v-for="(type, index) in pokemonTypes" class="inline-block w-1/4 mb-2">
                        <template v-if="index < limit">
                            <CardType                                
                                :key="index"
                                :type="type"      
                                class="inline-block w-full"            
                            />
                        </template>
                    </div>
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-1 mb-1 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <a href="/types/">Ver más</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
  </template>