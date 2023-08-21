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
        },
        hasShowMore: {
            type: Boolean,
            default: false,
        }
    });

</script>

<template>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-extrabold dark:text-white mb-4">Tipos de pokemón </h2>
                    <div v-if="!types.results.length">No tienes pokemones en tu lista de favoritos</div>
                    <div v-for="(type, index) in types.results.slice(0, limit)" :key="index" class="inline-block w-1/4 mb-2 px-2">
                        <CardType        
                            :type="type"      
                            class="inline-block w-full"  
                            v-if="type.name !== 'unknown' && type.name !== 'shadow'"
                        />
                    </div>
                    <br/>
                    <button v-if="hasShowMore" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-1 mb-1 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <a href="/types/">Ver más</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
  </template>