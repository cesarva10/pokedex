<script setup>
  import CardPokemon from '@/Pages/Pokemon/Partials/CardPokemon.vue';
  import { ref, computed } from 'vue';

  const { pokemons, limit, title, hasPagination } = defineProps({
    pokemons: {
      type: Object,
      default: null,
    },
    limit: {
      type: Number,
      default: 0,
    },
    title: {
      type: String,
      default: "",
    },
    hasPagination: {
      type: Boolean,
      default: false,
    },
    hasShowMore: {
      type: Boolean,
      default: false,
    },
  });

  const currentPage = ref(1);
  const itemsPerPage = 8;
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
</script>

<template>
  <div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h2 class="text-2xl font-extrabold dark:text-white mb-4">{{ title }}</h2>
          <div v-for="(pokemon, index) in visibleItems.slice(0, limit)" :key="index" class="inline-block w-1/4 mb-2 px-2">
            <CardPokemon 
              :pokemon="pokemon" 
              class="inline-block w-full"
            />
          </div>
          <div v-if="hasPagination" class="mt-4 flex justify-center">
            <button
              type="button"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-1 mb-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
              @click="prevPage"
              :disabled="currentPage === 1">
                Anterior
            </button>
            <button
              type="button"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 ml-1 mb-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
              @click="nextPage"
              :disabled="currentPage === totalPages">
                Siguiente
            </button>
          </div>
          <button v-if="hasShowMore" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-1 mb-1 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
              <a href="/favorites/">Ver más</a>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>