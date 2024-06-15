<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Maintenance } from '@/types/Maintenance';
import { Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import MaintenanceCard from './Partials/MaintenanceCard.vue';

const maintenances = usePage().props.maintenances as Maintenance[];
const pastMaintenance = ref<Maintenance[]>([]);
const todayMaintenance = ref<Maintenance[]>([]);
const upcomingMaintenance = ref<Maintenance[]>([]);

const today = new Date();

maintenances.forEach((maintenance) => {
  const maintenanceDate = new Date(maintenance.maintenanceDate);
  if (maintenanceDate < today) {
    pastMaintenance.value.push(maintenance);
  } else if (maintenanceDate.toDateString() === today.toDateString()) {
    todayMaintenance.value.push(maintenance);
  } else {
    upcomingMaintenance.value.push(maintenance);
  }
});
</script>

<template>
  <Head title="Maintenance" />

  <AuthenticatedLayout>
    <div class="m-4 flex flex-1 space-x-4">
      <div
        class="flex flex-1 flex-col space-y-4 rounded bg-white p-4 dark:bg-gray-800"
      >
        <h2 class="text-lg font-semibold underline underline-offset-4">
          Previous Maintenance
        </h2>
        <MaintenanceCard
          v-for="maintenance of pastMaintenance"
          :key="maintenance.id"
          :maintenance
        />
        <div
          v-if="!pastMaintenance.length"
          class="flex flex-1 items-center justify-center"
        >
          <p class="text-center">No maintenance recorded</p>
        </div>
      </div>
      <div
        class="flex flex-1 flex-col space-y-4 rounded bg-white p-4 dark:bg-gray-800"
      >
        <h2 class="text-lg font-semibold underline underline-offset-4">
          Today Maintenance
        </h2>
        <MaintenanceCard
          v-for="maintenance of todayMaintenance"
          :key="maintenance.id"
          :maintenance
        />
        <div
          v-if="todayMaintenance.length === 0"
          class="flex flex-1 items-center justify-center"
        >
          <p class="text-center">No maintenance scheduled for today</p>
        </div>
      </div>
      <div
        class="flex flex-1 flex-col space-y-4 rounded bg-white p-4 dark:bg-gray-800"
      >
        <h2 class="text-lg font-semibold underline underline-offset-4">
          Upcoming Maintenance
        </h2>
        <MaintenanceCard
          v-for="maintenance of upcomingMaintenance"
          :key="maintenance.id"
          :maintenance
        />
        <div
          v-if="!upcomingMaintenance.length"
          class="flex flex-1 items-center justify-center"
        >
          <p class="text-center">No upcoming maintenance scheduled</p>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
