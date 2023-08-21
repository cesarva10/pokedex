<script setup>
    import { defineEmits } from 'vue';

    defineProps({
        id: {
            type: Number,
            default: null,
        }
    });

    const emit = defineEmits(['deleted']);

    const deleteFavorite = (pokemon) => {
        axios.delete('/favorites/'+pokemon)
            .then(response => {                
                emit('deleted');
            })
            .catch(error => {
                console.error(error);
            });
    };
</script>

<template>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="toast-success" class="flex items-center w-full p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="sr-only">Ok</span>
                </div>
                <div class="ml-3 mr-5 text-sm font-normal">¡Este pokemon ya está entre tus favoritos!. ¿Deseas eliminarlo de tu pokedex?</div>
                <button @click="deleteFavorite(id)" class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="button">
                    Eliminar
                </button>
            </div> 
        </div>
    </div>
  </template>