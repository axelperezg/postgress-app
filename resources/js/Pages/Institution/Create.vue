<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';

const props = defineProps({
    sectors: {
        type: Array,
        required: true
    }
});

const form = useForm({
    sector_id: '',
    name: '',
    code: '',
    responsableInstitution: '',
    cargoInstitution: '',
    direccionEntrega: '',
    phone: '',
    map_google: ''
});

const submit = () => {
    form.post(route('institutions.store'));
};
</script>

<template>
    <Head title="Crear Institución" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Crear Nueva Institución
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <InputLabel for="sector_id" value="Sector" />
                                <select
                                    id="sector_id"
                                    v-model="form.sector_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option value="">Seleccione un sector</option>
                                    <option v-for="sector in sectors" :key="sector.id" :value="sector.id">
                                        {{ sector.name }}
                                    </option>
                                </select>
                                <InputError :message="form.errors.sector_id" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="name" value="Nombre" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                />
                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="code" value="Código" />
                                <TextInput
                                    id="code"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.code"
                                    required
                                />
                                <InputError :message="form.errors.code" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="responsableInstitution" value="Responsable" />
                                <TextInput
                                    id="responsableInstitution"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.responsableInstitution"
                                />
                                <InputError :message="form.errors.responsableInstitution" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="cargoInstitution" value="Cargo" />
                                <TextInput
                                    id="cargoInstitution"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.cargoInstitution"
                                />
                                <InputError :message="form.errors.cargoInstitution" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="direccionEntrega" value="Dirección de Entrega" />
                                <TextInput
                                    id="direccionEntrega"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.direccionEntrega"
                                />
                                <InputError :message="form.errors.direccionEntrega" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="phone" value="Teléfono" />
                                <TextInput
                                    id="phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.phone"
                                />
                                <InputError :message="form.errors.phone" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="map_google" value="Enlace de Google Maps" />
                                <TextInput
                                    id="map_google"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.map_google"
                                />
                                <InputError :message="form.errors.map_google" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end">
                                <PrimaryButton
                                    class="ml-4"
                                    :disabled="form.processing"
                                >
                                    Crear Institución
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template> 