<script setup lang="ts">
import { Car } from 'lucide-vue-next';

defineProps<{
  plateNumber: string;
  brand: string;
  model: string;
  color: string;
  status: string | null;
}>();
</script>

<template>
  <div class="space-y-4 rounded bg-gray-100 p-2 dark:bg-gray-800">
    <div class="rounded-lg border-4 border-white bg-black p-2">
      <span class="text-3xl font-bold text-white"> {{ plateNumber }} </span>
    </div>
    <div class="flex flex-col">
      <div class="flex items-center space-x-2">
        <span class="rounded-full shadow-md">
          <Car :size="18" :color="color" />
        </span>
        <span class="text-base font-semibold"> {{ brand }} {{ model }} </span>
        <span>{{ status?.toUpperCase() }}</span>
      </div>
    </div>
  </div>
</template>
