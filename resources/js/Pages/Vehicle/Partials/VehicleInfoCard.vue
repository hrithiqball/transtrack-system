<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';

defineProps<{ vehicle: Vehicle }>();
</script>

<template>
  <div class="rounded-lg bg-slate-200 p-4 dark:bg-slate-700">
    vehicle info hye {{ vehicle.plateNumber }}
  </div>
</template>
