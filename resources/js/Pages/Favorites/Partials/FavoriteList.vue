<script setup>

defineProps({
    list: {
        type: Array,
        default: null
    }
});
</script>

<template>
    <section>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <ul v-if="list.length">
                        <li v-for="(item, index) in list" :key="item.id">{{ item.pokemon }} - {{ item.created_at }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>
