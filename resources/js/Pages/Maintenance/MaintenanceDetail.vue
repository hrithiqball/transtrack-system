<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Maintenance } from '@/types/Maintenance';
import { Head, usePage } from '@inertiajs/vue3';
import { format } from 'date-fns';
import { computed } from 'vue';
import ServicedByInfoCard from '../Profile/Partials/ServicedByInfoCard.vue';
import VehicleInfoCard from '../Vehicle/Partials/VehicleInfoCard.vue';
import { Card } from '@/Components/ui/card';

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
  <Head title="Maintenance Detail" />

  <AuthenticatedLayout>
    <div class="flex flex-1 flex-col items-center justify-center space-y-4">
      <div>
        <div
          class="flex flex-1 flex-col items-center rounded-lg bg-white p-4 dark:bg-gray-800"
        >
          <span class="mt-4 text-2xl font-semibold">
            Maintenance ID: {{ maintenance.id }}
          </span>
          <Card
            class="my-4 flex size-24 flex-col items-center justify-center rounded-full p-6"
          >
            <span class="text-xl font-bold text-rose-500">
              {{ formattedDate.day }}
            </span>
            <span class="text-sm">{{ formattedDate.month }}</span>
            <span class="text-xs">{{ formattedDate.year }}</span>
          </Card>
          <Card class="my-4 flex w-full flex-col rounded-lg p-4">
            <span class="mb-4 underline underline-offset-4">Remarks</span>
            <span>{{ maintenance.remarks }}</span>
          </Card>
          <div class="grid grid-cols-2 gap-4">
            <VehicleInfoCard :vehicle="maintenance.vehicle" />
            <ServicedByInfoCard :servicedBy="maintenance.servicedBy" />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
