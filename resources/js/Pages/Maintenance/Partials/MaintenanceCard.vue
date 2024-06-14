<script setup lang="ts">
import { Maintenance } from '@/types/Maintenance';
import { format } from 'date-fns';
import { computed } from 'vue';
import { Card, CardContent, CardHeader } from '@/Components/ui/card';
import { router } from '@inertiajs/vue3';

const props = defineProps<{ maintenance: Maintenance }>();

const formattedDate = computed(() => {
  const date = new Date(props.maintenance.maintenanceDate);

  return {
    day: format(date, 'dd'),
    month: format(date, 'MMM'),
    year: format(date, 'yyyy'),
  };
});

const handleMaintenanceInfo = (id: number) => {
  router.visit(route('maintenance.detail', { id }));
};
</script>

<template>
  <Card class="cursor-pointer" @click="handleMaintenanceInfo(maintenance.id)">
    <CardHeader>
      <div class="flex items-center justify-center">
        <div>
          <span
            class="flex flex-1 items-center justify-center rounded-md border-2 border-solid border-white bg-black px-2"
          >
            {{ maintenance.vehicle.plateNumber }}
          </span>
        </div>
      </div>
    </CardHeader>
    <CardContent>
      <div class="flex flex-col space-y-4">
        <div class="flex space-x-2">
          <span class="font-semibold">
            {{ maintenance.vehicle.brand }}
          </span>
          <span class="italic">{{ maintenance.vehicle.model }}</span>
        </div>
        <div>
          <span class="text-sm italic">Remarks</span>
          <p>{{ maintenance.remarks }}</p>
        </div>
      </div>
    </CardContent>
  </Card>
</template>
