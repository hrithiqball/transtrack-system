<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';
import { Head, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdateVehicleForm from './Partials/UpdateVehicleForm.vue';

defineProps<{
  vehicle: Vehicle;
}>();

const vehicle = usePage().props.vehicle as Vehicle;
</script>

<template>
  <Head title="Edit Vehicle" />

  <AuthenticatedLayout>
    <UpdateVehicleForm :vehicle />
  </AuthenticatedLayout>
</template>
