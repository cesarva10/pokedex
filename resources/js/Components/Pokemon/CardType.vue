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
        <img class="w-full" :src="imageUrl" alt="">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ name.toUpperCase() }}</div>
            <p class="text-gray-700 text-base">{{ description }}</p>
            </div>
            <div class="px-6 pt-4 pb-2">
            <span class="w-1/2 overflow-hidden bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Pokemones: {{ pokemonsCount }}</span>
            <span class="w-1/2 overflow-hidden bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Movs: {{ movesCount }}</span>
            <button class="btn btn-blue">Ver todos</button>
        </div>
    </div>
</template>