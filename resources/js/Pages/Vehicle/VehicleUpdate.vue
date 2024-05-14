<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';
import { InertiaForm, Head, useForm, usePage } from '@inertiajs/vue3';
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
    <!-- <template #header>
      <div>
      </div>
    </template> -->
    <p>
      {{ vehicle.plate_number }}
    </p>
    <UpdateVehicleForm :vehicle />
  </AuthenticatedLayout>
</template>
