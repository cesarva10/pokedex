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
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ ability.ability.name }}</span>
        </div>
    </div>
</template>