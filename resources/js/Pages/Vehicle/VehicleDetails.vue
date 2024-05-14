<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';
import { usePage } from '@inertiajs/vue3';

defineProps<{ vehicle: Vehicle }>();
const vehicle = usePage().props.vehicle as Vehicle;
</script>

<template>
  <div>details {{ vehicle.plate_number }}</div>
</template>
