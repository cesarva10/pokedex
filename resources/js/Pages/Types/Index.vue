<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import TypeList from './Partials/TypeList.vue';

    defineProps({
        pokemonTypes: {
            type: Object,
            default: null
        }
    });
</script>

<template>
    <Head title="Tipos de pokemón" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tipos de pokemón</h2>
        </template>

        <TypeList :pokemonTpyes="pokemonTypes"/>
    </AuthenticatedLayout>
</template>