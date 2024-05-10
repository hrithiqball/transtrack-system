<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';
import { router } from '@inertiajs/vue3';

defineProps<{ vehicle: Vehicle }>();

const navigateToVehiclePage = (id: number) => {
  console.log(id);
  router.visit('booking');
};
</script>

<template>
  <span
    class="cursor-pointer underline-offset-4 hover:text-blue-500 hover:underline"
    @click="navigateToVehiclePage(vehicle.id)"
  >
    {{ vehicle.plate_number }}
  </span>
</template>
