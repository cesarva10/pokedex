<script setup>
    import axios from 'axios';
    import { ref, onMounted } from 'vue';

    const props = defineProps({
        type: Object
    });

    const name = ref('');
    const description = ref('');
    const pokemonsCount = ref(0);
    const movesCount = ref(0);

    onMounted(async () => {
        try {
            const response = await axios.get(`https://pokeapi.co/api/v2/type/${props.type.name}`);
            const typeData = response.data;
            pokemonsCount.value = typeData.pokemon.length;
            movesCount.value = typeData.moves.length;
            name.value = typeData.name;
        } catch (error) {
            console.error('Error fetching API data:', error);
        }
    });

    function capitalize(s) {
        return s.charAt(0).toUpperCase() + s.slice(1);
    }
</script>

<template>
    <div class="w-1/4 rounded overflow-hidden shadow-md">
        <img class="w-1/3 mx-auto mt-4" :src="'/images/types/'+name+'.png'" alt="Tipo de pokemon">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ capitalize(name) }}</div>
            </div>
            <div class="px-6 pt-4 pb-2 bg-amber-100">
            <span class="w-1/2 overflow-hidden bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Total: {{ pokemonsCount }}</span>
            <span class="w-1/2 overflow-hidden bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Movs: {{ movesCount }}</span>
            <a :href="'/types/'+name" class="mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Ver todos
                <svg class="w-4 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div>
</template>