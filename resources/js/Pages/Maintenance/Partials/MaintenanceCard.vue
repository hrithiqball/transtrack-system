<script setup lang="ts">
import { Card, CardContent, CardHeader } from '@/Components/ui/card';
import { Maintenance } from '@/types/Maintenance';
import { router } from '@inertiajs/vue3';
import { format } from 'date-fns';
import { CarIcon, UserIcon } from 'lucide-vue-next';
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

const handleMaintenanceInfo = (id: number) => {
  router.visit(route('maintenance.detail', { id }));
};
</script>

<template>
  <Card class="cursor-pointer" @click="handleMaintenanceInfo(maintenance.id)">
    <CardHeader>
      <div class="flex items-center justify-between">
        <div>
          <span
            class="flex flex-1 items-center justify-center rounded-md border-2 border-solid border-white bg-black px-2 text-white shadow-md dark:shadow-2xl"
          >
            {{ maintenance.vehicle.plateNumber }}
          </span>
        </div>
        <span>
          {{ formattedDate.day }} {{ formattedDate.month }}
          {{ formattedDate.year }}
        </span>
      </div>
    </CardHeader>
    <CardContent>
      <div class="flex flex-col space-y-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-2">
            <CarIcon :size="18" />
            <span class="font-semibold">
              {{ maintenance.vehicle.brand }}
            </span>
            <span class="italic">{{ maintenance.vehicle.model }}</span>
          </div>
          <div class="flex items-center space-x-2">
            <UserIcon :size="18" />
            <span>
              {{ maintenance.servicedBy.name }}
            </span>
          </div>
        </div>
        <div>
          <span class="text-sm italic underline underline-offset-4">
            Remarks
          </span>
          <p>{{ maintenance.remarks }}</p>
        </div>
      </div>
    </CardContent>
  </Card>
</template>
