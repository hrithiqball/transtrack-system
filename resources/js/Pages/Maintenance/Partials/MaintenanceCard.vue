<script setup lang="ts">
import { Maintenance } from '@/types/Maintenance';
import { format } from 'date-fns';
import { computed } from 'vue';

const props = defineProps<{ maintenance: Maintenance }>();

const formattedDate = computed(() => {
  const date = new Date(props.maintenance.maintenanceDate);

  return {
    day: format(date, 'dd'),
    month: format(date, 'MMM'),
    year: format(date, 'yyyy'),
  };
});
</script>

<template>
  <div class="flex flex-col rounded-lg border border-solid border-input p-4">
    <div class="flex justify-between">
      <div class="flex flex-col space-y-4">
        <div
          class="rounded-md border-2 border-solid border-white bg-black px-4 text-white"
        >
          <span>
            {{ props.maintenance.vehicle.plateNumber }}
          </span>
        </div>
        <div class="flex space-x-2">
          <span class="font-semibold">
            {{ props.maintenance.vehicle.brand }}
          </span>
          <span class="italic">{{ props.maintenance.vehicle.model }}</span>
        </div>
        <div>
          <span class="text-sm italic">Remarks</span>
          <p>{{ props.maintenance.remarks }}</p>
        </div>
      </div>
      <div class="flex flex-col justify-center">
        <span class="text-center text-lg font-semibold">
          {{ formattedDate.day }}
        </span>
        <span class="text-center">{{ formattedDate.month }}</span>
      </div>
    </div>
  </div>
</template>
