<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Maintenance } from '@/types/Maintenance';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { format } from 'date-fns';

const maintenance = usePage().props.maintenance as Maintenance;
const formattedDate = computed(() => {
  const date = new Date(maintenance.maintenanceDate);

  return {
    day: format(date, 'dd'),
    month: format(date, 'MMMM'),
    year: format(date, 'yyyy'),
  };
});
</script>

<template>
  <AuthenticatedLayout>
    <div class="flex flex-col items-center space-y-4">
      <span class="mt-4 text-2xl font-semibold">
        Maintenance ID: {{ maintenance.id }}
      </span>
      <div
        class="flex size-24 flex-col items-center justify-center rounded-full bg-slate-200 p-6 dark:bg-slate-500"
      >
        <span class="text-xl font-bold text-rose-500 dark:text-rose-800">
          {{ formattedDate.day }}
        </span>
        <span class="text-sm">{{ formattedDate.month }}</span>
        <span class="text-xs">{{ formattedDate.year }}</span>
      </div>
      <span>{{ maintenance.remarks }}</span>
      <div class="grid grid-cols-2 gap-4">
        <div class="rounded-lg bg-red-100 p-4">TODO: vehicle info</div>
        <div class="rounded-lg bg-red-100 p-4">TODO: serviced by info</div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
