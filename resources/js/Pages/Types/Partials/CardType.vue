<script setup>
    import axios from 'axios';
    import { ref, onMounted } from 'vue';

    const props = defineProps({
        type: Object
    });

    const imageUrl = ref('');
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
</script>

<template>
    <div class="w-1/4 rounded overflow-hidden shadow-md">
        <img class="w-full" :src="imageUrl" alt="Pokemon">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ name.toUpperCase() }}</div>
            </div>
            <div class="px-6 pt-4 pb-2">
            <span class="w-1/2 overflow-hidden bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Pokemones: {{ pokemonsCount }}</span>
            <span class="w-1/2 overflow-hidden bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Movs: {{ movesCount }}</span>
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-1 mb-1 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <a :href="'/types/'+name">Ver todos</a>
            </button>
        </div>
    </div>
</template>