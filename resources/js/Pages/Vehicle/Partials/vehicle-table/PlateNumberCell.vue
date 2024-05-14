<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps<{ vehicle: Vehicle }>();

const navigateToVehiclePage = (id: number) => {
  // router.visit(`booking.index`, { id });
};
</script>

<template>
  <Link
    class="cursor-pointer underline-offset-4 hover:text-blue-500 hover:underline"
    :href="route('vehicle.edit', { id: vehicle.id })"
  >
    {{ vehicle.plate_number }}
  </Link>
</template>
