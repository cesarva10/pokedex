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
                    <table class="table-fixed">
                        <thead>
                            <tr>
                            <th>Pokemon</th>
                            <th>Tipo</th>
                            <th>Agregado</th>
                            <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in list" :key="item.id">
                                <td>{{ item.pokemon }}</td>
                                <td>{{ item.created_at }}</td>
                                <td>{{ item.created_at }}</td>
                                <td>
                                    <button class="btn btn-blue">Ver</button>
                                    <button class="btn btn-red">Eliminar</button>
                                </td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>
