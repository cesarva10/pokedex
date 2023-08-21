<script setup>
    import { reactive, computed } from 'vue'

    const props = defineProps({
        stats: Object,
    });

    function capitalize(s) {
        return s.charAt(0).toUpperCase() + s.slice(1);
    }
</script>

<template>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-extrabold dark:text-white mb-4">Estadísticas: </h2>
                    <div class="mb-4" v-for="(stat, index) in stats" :key="index" :type="stat">
                        <div class="flex justify-between mb-1">
                            <span class="text-base font-medium text-blue-700 dark:text-white">{{ capitalize(stat.stat.name) }}</span>
                            <span class="text-sm font-medium text-blue-700 dark:text-white">{{ stat.base_stat }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div v-if="stat.base_stat < 100" :class="(stat.base_stat < 80)?'bg-yellow-400':'bg-blue-600'" class="h-2.5 rounded-full" :style="`width: ${stat.base_stat}%;`"></div>
                            <div v-else="stat.base_stat < 100" :class="(stat.base_stat < 80)?'bg-yellow-400':'bg-blue-600'" class="h-2.5 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </template>