<script setup>
  import CardPokemon from '@/Pages/Pokemon/Partials/CardPokemon.vue';
  import { ref, computed } from 'vue';
import ToastEmpty from './ToastEmpty.vue';

  const { pokemons, title, hasPagination } = defineProps({
    pokemons: {
      type: Object,
      default: null,
    },
    title: {
      type: String,
      default: "",
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
          <h2 class="text-2xl font-extrabold dark:text-white mb-4">{{ title }}</h2>
          <ToastEmpty v-if="!pokemons.length" />
          <div v-else class="grid xs:grid-cols-1 sm:grid-cols-4">
            <div v-for="(pokemon, index) in pokemons" :key="index" class="mb-2 px-2">
              <CardPokemon 
                :pokemon="pokemon" 
                class="w-full"
              />
            </div>
          </div>
          <button v-if="hasShowMore && pokemons.length" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-1 mb-1 mt-0 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
              <a href="/favorites/">Ver más</a>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>