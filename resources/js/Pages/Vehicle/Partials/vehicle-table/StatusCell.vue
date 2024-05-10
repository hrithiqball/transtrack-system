<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';

defineProps<{ vehicle: Vehicle }>();
</script>

<template>
  <span
    v-if="vehicle.status === 'Unavailable To Operate'"
    class="rounded bg-gray-800 px-2"
  >
    {{ vehicle.status }}
  </span>
  <span
    v-if="vehicle.status === 'Ready To Operate'"
    class="rounded bg-green-800 px-2"
  >
    {{ vehicle.status }}
  </span>
  <span
    v-if="vehicle.status === 'Currently In Use'"
    class="rounded bg-yellow-800 px-2"
  >
    {{ vehicle.status }}
  </span>
  <span
    v-if="vehicle.status === 'In Maintenance'"
    class="rounded bg-orange-800 px-2"
  >
    {{ vehicle.status }}
  </span>
  <span v-if="!vehicle.status">N/A</span>
</template>
