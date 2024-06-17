<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';

defineProps<{ vehicle: Vehicle }>();
</script>

<template>
  <span
    v-if="vehicle.status === 'unavailable'"
    class="rounded bg-gray-800 px-2 py-1 text-xs text-white"
  >
    Unavailable
  </span>
  <span
    v-else-if="vehicle.status === 'available'"
    class="rounded bg-green-800 px-2 py-1 text-xs text-white"
  >
    Available
  </span>
  <span
    v-else-if="vehicle.status === 'in_use'"
    class="rounded bg-yellow-800 px-2 py-1 text-xs text-white"
  >
    In Use
  </span>
  <span
    v-else-if="vehicle.status === 'maintenance'"
    class="rounded bg-orange-800 px-2 py-1 text-xs text-white"
  >
    Maintenance
  </span>
  <span v-else class="rounded bg-gray-800 px-2 py-1 text-xs text-white"
    >N/A</span
  >
</template>
