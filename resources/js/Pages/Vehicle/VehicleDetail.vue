<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Vehicle } from '@/types/Vehicle';
import { Head, usePage } from '@inertiajs/vue3';
import VehicleDetailsCard from './Partials/VehicleDetailsCard.vue';
import VehicleImageCard from './Partials/VehicleImageCard.vue';
import VehicleMaintenanceCard from './Partials/VehicleMaintenanceCard.vue';
import VehicleMapCard from './Partials/VehicleMapCard.vue';

const vehicle = usePage().props.vehicle as Vehicle;
</script>

<template>
  <Head title="Vehicle Details" />

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="mx-auto max-w-7xl space-y-4 sm:px-6 lg:px-8">
        <div
          class="overflow-hidden bg-white p-4 shadow-sm dark:bg-gray-800 sm:rounded-lg"
        >
          <div className="grid grid-cols-3 gap-4 h-[250px]">
            <VehicleImageCard :photo="vehicle.photo" />
            <VehicleMapCard :lat="vehicle.latitude" :lng="vehicle.longitude" />
            <VehicleDetailsCard :vehicle />
          </div>
        </div>
        <div
          class="overflow-hidden bg-white p-4 shadow-sm dark:bg-gray-800 sm:rounded-lg"
        >
          <VehicleMaintenanceCard :maintenances="vehicle.maintenances" />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
