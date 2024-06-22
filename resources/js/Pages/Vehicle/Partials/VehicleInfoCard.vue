<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';
import { router } from '@inertiajs/vue3';
import { Car } from 'lucide-vue-next';
import { Card } from '@/Components/ui/card';

defineProps<{ vehicle: Vehicle }>();

const handleVisitVehicle = (id: number) => {
  router.visit(route('vehicle.detail', { id }));
};
</script>

<template>
  <Card
    class="flex cursor-pointer flex-col items-center space-y-4 rounded-lg p-4"
    @click="handleVisitVehicle(vehicle.id)"
  >
    <span class="text-lg font-semibold">Vehicle</span>
    <div class="w-36">
      <img
        :src="`/storage/${vehicle.photo}`"
        :alt="`${vehicle.brand} ${vehicle.model}`"
        class="rounded-lg"
      />
    </div>
    <div class="mb-2">
      <span
        class="rounded-md border-2 border-white bg-black px-2 py-1 text-white"
      >
        {{ vehicle.plateNumber }}
      </span>
    </div>
    <div class="flex flex-col text-center">
      <div class="flex items-center space-x-1">
        <Car :size="18" />
        <span>{{ vehicle.brand }}</span>
        <span>{{ vehicle.model }}</span>
      </div>
      <div class="mt-2">
        <span
          v-if="vehicle.status === 'available'"
          class="rounded-lg bg-slate-300 px-2 py-1 text-green-500 dark:bg-slate-800"
        >
          Available
        </span>
        <span
          v-else-if="vehicle.status === 'maintenance'"
          class="rounded-lg bg-slate-300 px-2 py-1 text-orange-500 dark:bg-slate-800"
        >
          Maintenance
        </span>
        <span
          v-else-if="vehicle.status === 'in_use'"
          class="rounded-lg bg-slate-300 px-2 py-1 text-yellow-500 dark:bg-slate-800"
        >
          In Use
        </span>
        <span
          v-else-if="vehicle.status === 'unavailable'"
          class="rounded-lg bg-slate-300 px-2 py-1 text-red-500 dark:bg-slate-800"
        >
          Unavailable
        </span>
        <span
          v-else
          class="rounded-lg bg-slate-300 px-2 py-1 text-gray-500 dark:bg-slate-800"
        >
          Not Stated
        </span>
      </div>
    </div>
  </Card>
</template>
