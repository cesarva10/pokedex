<script setup>
    defineProps({
        pokemonTypes: {
            type: Object,
            default: null
        }
    });
</script>

<template>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-extrabold dark:text-white mb-4">Tipos de pokemón:</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div v-for="(type, index) in pokemonTypes" class="grid gap-4">
                            <div>
                                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg" alt="">
                            </div>
                            <div>
                                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg" alt="">
                            </div>
                            <div>
                                <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>