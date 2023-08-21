<script setup>
    import ToastEmpty from '@/Pages/Pokemon/Partials/ToastEmpty.vue';
    import { ref, computed } from 'vue';

    const { pokemons } = defineProps({
        pokemons: {
            type: Object,
            default: null,
        }
    });
    
    const currentPage = ref(1);
    const itemsPerPage = 5;
    const items = ref(pokemons);

    const totalPages = computed(() => Math.ceil(items.value.length / itemsPerPage));
    const startIndex = computed(() => (currentPage.value - 1) * itemsPerPage);
    const endIndex = computed(() => startIndex.value + itemsPerPage);

    const visibleItems = computed(() => items.value.slice(startIndex.value, endIndex.value));

    const prevPage = () => {
        if (currentPage.value > 1) {
        currentPage.value--;
        }
    };

    const nextPage = () => {
        if (currentPage.value < totalPages.value) {
        currentPage.value++;
        }
    };
    
    function capitalize(s) {
        return s.charAt(0).toUpperCase() + s.slice(1);
    }
</script>

<template>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-extrabold dark:text-white mb-4">Todos los pokemones</h2>
                    <ToastEmpty v-if="!pokemons.length" />
                    <div v-else class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="flex items-center justify-between pb-4">                            
                            <span class="mx-5 text-lg text-gray-700 dark:text-gray-400">
                                Página <span class="font-semibold text-gray-900 dark:text-white">{{ currentPage }}</span> de <span class="font-semibold text-gray-900 dark:text-white">{{ totalPages }}</span>
                            </span>
                            <span class="mx-5 text-lg text-gray-700 dark:text-gray-400">
                                Total de pokemones: <span class="font-semibold text-gray-900 dark:text-white">{{ items.length }}</span>
                            </span>
                        </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-md text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Pokemon
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tipo
                                    </th>
                                    <th scope="col" class="px-6 py-3 w-1/6">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pokemon in visibleItems" :key="pokemon.id" :id="pokemon.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-20 h-30" :src="pokemon.sprites.other['official-artwork'].front_default" alt="Pokemon">                                        
                                    </th>
                                    <td class="px-6 py-4">
                                        <div class="pl-3">
                                            <div class="text-base font-semibold">{{ pokemon.id }}</div>
                                        </div>  
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="pl-3">
                                            <div class="text-base font-semibold">{{ capitalize(pokemon.name) }}</div>
                                        </div>  
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="pl-3">
                                            <div v-for="type in pokemon.types" :key="type.slot" class="text-base font-semibold inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                                {{ capitalize(type.type.name) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 flex">
                                        <a :href="'/pokemons/'+pokemon.name" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mx-2 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="width-full flex items-center my-5 items-center mx-5">
                            <button
                                type="button"
                                class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                @click="prevPage"
                                :disabled="currentPage === 1">
                                    <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                                    </svg>
                                    Anterior
                            </button>
                            <button
                                type="button"
                                class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                @click="nextPage"
                                :disabled="currentPage === totalPages">                                    
                                    Siguiente
                                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
