<script setup>
    import axios from 'axios';
    import { ref, onMounted } from 'vue';

    const props = defineProps({
        favorite: Object
    });

    const name = ref('');    
    const type = ref('');   
    const abilities = ref(''); 
    const movesCount = ref(''); 
    const image = ref('');

    onMounted(async () => {
        try {
            const response = await axios.get(`https://pokeapi.co/api/v2/pokemon/${props.favorite.pokemon}`);
            const typeData = response.data;
            name.value = typeData.name;            
            type.value = typeData.types[0].type.name; 
            abilities.value = typeData.abilities; 
            movesCount.value = typeData.moves.length; 
            image.value = typeData.sprites.other.dream_world.front_default;
        } catch (error) {
            console.error('Error fetching API data:', error);
        }
    });
</script>

<template>
    <div class="w-1/4 rounded overflow-hidden shadow-md">
        <img class="w-1/2 mx-auto" :src="image" alt="">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ name.toUpperCase() }}</div>
            <p class="text-gray-700 text-base">
                {{ type }}
            </p>
        </div>
        <div class="px-6 pt-4 pb-2">
            <span v-for="(ability, index) in abilities"
                :key="index"
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                {{ ability.ability.name }}
            </span>
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-1 mb-1 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <a :href="'/pokemons/'+name">Ver pokemón</a>
            </button>
        </div>
    </div>
</template>