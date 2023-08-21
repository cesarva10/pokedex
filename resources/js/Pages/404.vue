<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';

    defineProps({
        module: {
            type: String,
            default: null
        },
        value: {
            type: String,
            default: null
        }
    });

    function capitalize(s) {
        return s.charAt(0).toUpperCase() + s.slice(1);
    }
</script>

<template>
    <Head title="Pokemones" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ capitalize(module) }} desconocido</h2>
        </template>
        <div class="lg:px-24 lg:py-24 md:py-20 md:px-44 px-4 py-24 items-center flex justify-center flex-col-reverse lg:flex-row md:gap-28 gap-16">
            <div class="xl:pt-24 w-full xl:w-1/2 relative pb-12 lg:pb-0">
                <div class="relative">
                    <div class="block"> 
                        <img class="my-3" src="/images/404.png" />
                        <h1 class="my-2 text-gray-800 font-bold text-2xl">
                            Parece que el {{ module }}: 
                            <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                                {{ capitalize(value) }}
                            </span> 
                            no existe en la pokedex
                        </h1>
                        <p class="my-5 text-gray-800">Inténtalo nuevamente...</p>
                        <a href="/dashboard" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            Volver a inicio
                        </a>
                    </div>
                </div>
            </div>
            <div>
                <img src="/images/psyduck.png" class="w-60" />
            </div>
        </div>     
    </AuthenticatedLayout>
</template>