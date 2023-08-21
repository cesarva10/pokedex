<script setup>
    import axios from 'axios';
    import { ref, onMounted } from 'vue';

    const props = defineProps({
        pokemon: Object
    });

    const name = ref('');    
    const type = ref('');   
    const abilities = ref(''); 
    const movesCount = ref(''); 
    const image = ref('');

    onMounted(async () => {
        try {
            const response = await axios.get(`https://pokeapi.co/api/v2/pokemon/${props.pokemon.pokemon}`);
            const typeData = response.data;
            name.value = typeData.name;
            type.value = typeData.types[0].type.name; 
            abilities.value = typeData.abilities; 
            movesCount.value = typeData.moves.length; 
            image.value = typeData.sprites.other['official-artwork'].front_default;
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
        <img class="w-1/2 mx-auto" :src="image" alt="">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ capitalize(name) }}</div>
            <p class="text-gray-700 text-base">
                {{ capitalize(type) }}
            </p>
        </div>
        <div class="px-6 pt-4 pb-2 bg-sky-100">
            <span v-for="(ability, index) in abilities"
                :key="index"
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                {{ capitalize(ability.ability.name) }}
            </span>
            <br/>
            <a :href="'/pokemons/'+name" class="mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Detalles
                <svg class="w-4 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div>
</template>