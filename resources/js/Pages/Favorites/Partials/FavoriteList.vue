<script setup>
    import ToastEmpty from '@/Pages/Pokemon/Partials/ToastEmpty.vue';
    import moment from 'moment'
    import { ref, computed } from 'vue';

    const { favoritesData } = defineProps({
        favoritesData: {
            type: Object,
            default: null,
        }
    });
    
    const currentPage = ref(1);
    const itemsPerPage = 10;
    const items = ref(favoritesData);

    const totalPages = computed(() => Math.ceil(items.value.length / itemsPerPage));
    const startIndex = computed(() => (currentPage.value - 1) * itemsPerPage);
    const endIndex = computed(() => startIndex.value + itemsPerPage);

    const visibleItems = computed(() => items.value.slice(startIndex.value, endIndex.value));
    
    const loading = ref(false);

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

    const deleteFavorite = (pokemon) => {       
        loading.value = true;
        axios.delete('/favorites/'+pokemon)
            .then(response => {
                const index = items.value.findIndex(item => item.id === pokemon);
                if (index !== -1) {
                    items.value.splice(index, 1);
                }
            })
            .catch(error => {
                console.error(error);
            })
            .finally(function(){
                 loading.value = false
            });
    };

    function capitalize(s) {
        return s.charAt(0).toUpperCase() + s.slice(1);
    }
</script>

<template>
    <div v-if="loading === true" class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div role="status" class="mx-2 flex">
                        <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <h2 class="text-lg font-extrabold dark:text-white ml-2 mb-4">Eliminado pokemón de la lista de favoritos...</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-extrabold dark:text-white mb-4">Favoritos recientes:</h2>
                    <ToastEmpty v-if="!favoritesData.length" />
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
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tipo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Agregado
                                    </th>
                                    <th scope="col" class="px-6 py-3 w-1/6">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pokemon, index) in visibleItems" :key="pokemon.id" :id="pokemon.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-20 h-30" :src="pokemon.sprites.other.dream_world.front_default" alt="Pokemon">                                        
                                    </th>
                                    <td class="px-6 py-4">
                                        <div class="pl-3">
                                            <div class="text-base font-semibold">{{ capitalize(pokemon.name) }}</div>
                                        </div>  
                                    </td>
                                    <td class="px-6 py-4">
                                        <div v-for="type in pokemon.types" :key="type.slot" class="text-base font-semibold inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                            {{ capitalize(type.type.name) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="pl-3">
                                            <div class="text-base font-semibold">{{ moment(pokemon.favorite.created_at).format('DD/MM/YYYY h:mm a') }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 flex">
                                        <a :href="'/pokemons/'+pokemon.name" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mx-2 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                            Ver
                                        </a>
                                        <button @click="deleteFavorite(pokemon.id)" class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
                                            Eliminar
                                        </button>                                        
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
