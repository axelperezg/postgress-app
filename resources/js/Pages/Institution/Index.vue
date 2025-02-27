<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import { router } from '@inertiajs/vue3';

defineProps({
    institutions: {
        type: Array,
        required: true
    }
});

const deleteInstitution = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar esta institución?')) {
        router.delete(route('institutions.destroy', id));
    }
};
</script>

<template>
    <Head title="Instituciones" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Instituciones
                </h2>
                <Link
                    :href="route('institutions.create')"
                    class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700"
                >
                    Nueva Institución
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Sector
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Código
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Responsable
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Teléfono
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="institution in institutions" :key="institution.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ institution.sector.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ institution.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ institution.code }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ institution.responsableInstitution }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ institution.phone }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <Link
                                                :href="route('institutions.edit', institution.id)"
                                                class="text-indigo-600 hover:text-indigo-900 mr-4"
                                            >
                                                Editar
                                            </Link>
                                            <button
                                                @click="deleteInstitution(institution.id)"
                                                class="text-red-600 hover:text-red-900"
                                            >
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template> 