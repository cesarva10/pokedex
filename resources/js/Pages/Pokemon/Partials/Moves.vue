<script setup>
    const props = defineProps({
        moves: Object,
    });
</script>

<template>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-extrabold dark:text-white mb-4">Movimientos: </h2>                                     
                    <div class="flex flex-wrap">
                        <div class="mb-4" v-for="(move, index) in moves" :key="index">
                            <span class="inline-block bg-blue-100 text-blue-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ move.move.name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </template>