<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';
import { Maintenance } from '@/types/Maintenance';
import { router } from '@inertiajs/vue3';
import { format } from 'date-fns';
import { Ban, CarIcon, Check, UserIcon } from 'lucide-vue-next';
import { computed } from 'vue';

const props = defineProps<{ maintenance: Maintenance }>();

const formattedDate = computed(() => {
  const date = new Date(props.maintenance.maintenanceDate);

  return {
    day: format(date, 'dd'),
    month: format(date, 'MM'),
    year: format(date, 'yy'),
  };
});

const handleMaintenanceInfo = (id: number) => {
  router.visit(route('maintenance.detail', { id }));
};
</script>

<template>
  <Card
    class="flex-1 cursor-pointer"
    @click="handleMaintenanceInfo(maintenance.id)"
  >
    <CardHeader>
      <CardTitle> Maintenance ID: {{ maintenance.id }} </CardTitle>
      <CardDescription>
        {{ formattedDate.day }}/{{ formattedDate.month }}/{{
          formattedDate.year
        }}, {{ maintenance.remarks }}</CardDescription
      >
    </CardHeader>
    <CardContent>
      <div class="flex flex-col space-y-2">
        <div class="flex">
          <div
            v-if="maintenance.completed"
            class="flex items-center space-x-1 rounded-sm bg-green-500 px-2 py-1 text-white"
          >
            <Check :size="15" />
            <span class="pr-1 text-sm"> Maintenance is completed </span>
          </div>
          <div
            v-else
            class="flex items-center space-x-1 rounded-sm bg-red-500 px-2 py-1 text-white"
          >
            <Ban :size="15" />
            <span class="pr-1 text-sm"> Maintenance is not completed </span>
          </div>
        </div>
        <div class="flex">
          <div
            class="rounded-sm border border-white bg-black px-2 font-semibold text-white shadow-xl"
          >
            {{ maintenance.vehicle.plateNumber }}
          </div>
        </div>
      </div>
    </CardContent>
  </Card>
</template>
