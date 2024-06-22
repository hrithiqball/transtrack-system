<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Maintenance } from '@/types/Maintenance';
import { Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import MaintenanceCard from './Partials/MaintenanceCard.vue';
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';

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
    <template #header>
      <div class="grid grid-cols-3 gap-4">
        <Card class="flex flex-col">
          <CardHeader>
            <CardTitle> Previous Maintenance </CardTitle>
            <CardDescription>
              View all maintenance records that have been completed
            </CardDescription>
          </CardHeader>
          <CardContent class="flex flex-1">
            <MaintenanceCard
              v-for="maintenance of pastMaintenance"
              :key="maintenance.id"
              :maintenance
            />
            <div
              v-if="!pastMaintenance.length"
              class="flex flex-1 items-center justify-center"
            >
              <p class="text-center">No maintenance records found</p>
            </div>
          </CardContent>
        </Card>
        <Card class="flex flex-col">
          <CardHeader>
            <CardTitle> Today Maintenance </CardTitle>
            <CardDescription>
              View all maintenance scheduled for today
            </CardDescription>
          </CardHeader>
          <CardContent class="flex flex-1">
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
          </CardContent>
        </Card>
        <Card class="flex flex-col">
          <CardHeader>
            <CardTitle> Upcoming Maintenance </CardTitle>
            <CardDescription>
              View all maintenance scheduled for the future
            </CardDescription>
          </CardHeader>
          <CardContent class="flex flex-1">
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
          </CardContent>
        </Card>
      </div>
    </template>
  </AuthenticatedLayout>
</template>
