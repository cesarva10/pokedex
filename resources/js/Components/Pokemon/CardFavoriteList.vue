<script setup>
    import CardFavorite from '@/Components/Pokemon/CardFavorite.vue';
    const { types, limit } = defineProps({
        limit: {
            type: Number,
            default: null,
        },
        favorites: {
            type: Object,
            default: null,
        },
    });
</script>

<template>
  <div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h2>Favoritos recientes:</h2>
          <div class="flex flex-wrap">
            <CardFavorite
                v-for="(item, index) in limit"
                :key="index"
                :favorite="favorites[index]"
                class="inline-block w-1/4 mb-2"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>