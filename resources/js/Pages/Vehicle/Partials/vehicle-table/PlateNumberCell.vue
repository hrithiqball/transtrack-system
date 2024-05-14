<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';
import { Link } from '@inertiajs/vue3';

defineProps<{ vehicle: Vehicle }>();
</script>

<template>
  <Link
    class="cursor-pointer underline-offset-4 hover:text-blue-500 hover:underline"
    :href="route('vehicle.detail', { id: vehicle.id })"
  >
    {{ vehicle.plate_number }}
  </Link>
</template>
