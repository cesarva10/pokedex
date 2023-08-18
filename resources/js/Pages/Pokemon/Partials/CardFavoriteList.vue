<script setup>
    import CardFavorite from '@/Pages/Pokemon/Partials/CardFavorite.vue';
    const { favorites, showLess } = defineProps({
        favorites: {
            type: Object,
            default: null,
        },
        showLess: {
          type: Boolean,
          default: true,
        }
    });
</script>

<template>
  <div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h2>Favoritos recientes:</h2>
          <div v-if="showLess">
            <div v-for="(value,index) in favorites" class="inline-block w-1/4 mb-2">
              <CardFavorite 
                v-if="index <= 4" 
                :key="index"
                :favorite="favorites[index]"      
                class="inline-block w-full"            
              />
            </div>
          </div>
          <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 mr-1 mb-1 mt-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" @click="showLess = false">Ver más</button>
        </div>
      </div>
    </div>
  </div>
</template>