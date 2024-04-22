<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import AddVehicleForm from './Partials/AddVehicleForm.vue';
import { usePage } from '@inertiajs/vue3';

const { vehicles } = usePage().props as any;
console.log(vehicles);
</script>

<template>
  <Head title="Vehicle" />

  <AuthenticatedLayout>
    <template #header>
      <h2
        class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
      >
        Vehicle
      </h2>
    </template>

    <div class="space-y-4 py-4">
      <div class="mx-auto max-w-7xl space-y-4 sm:px-4 lg:px-8">
        <div class="rounded-lg bg-white p-4 shadow dark:bg-gray-800">
          <div v-for="vehicle in vehicles" :key="vehicle.id">
            {{ vehicle.brand }}
          </div>
        </div>
      </div>
      <div class="mx-auto max-w-7xl space-y-4 sm:px-4 lg:px-8">
        <div class="bg-white p-4 shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
          <AddVehicleForm />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
