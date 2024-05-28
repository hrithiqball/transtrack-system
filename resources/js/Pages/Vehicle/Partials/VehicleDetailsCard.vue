<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';

defineProps<{
  vehicle: Vehicle;
}>();
</script>

<template>
  <div
    class="flex min-h-60 flex-1 flex-col space-y-4 rounded-lg bg-slate-500 p-4"
  >
    <div
      class="rounded-md border-2 border-solid border-white bg-black px-4 py-1 text-white"
    >
      <span class="text-2xl font-semibold">
        {{ vehicle.plateNumber }}
      </span>
    </div>
    <div class="flex flex-col">
      <div class="flex items-center justify-evenly space-x-1">
        <div
          class="size-4 rounded-full"
          :style="{ backgroundColor: vehicle.color }"
        ></div>
        <span class="font-semibold"> {{ vehicle.brand }} </span>
        <span class="italic"> {{ vehicle.model }} </span>
      </div>
      <span>Year of make: {{ vehicle.year }}</span>
    </div>
  </div>
</template>
