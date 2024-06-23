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
import { XIcon } from 'lucide-vue-next';

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
          <CardContent class="flex flex-col space-y-2">
            <MaintenanceCard
              v-for="maintenance of pastMaintenance"
              :key="maintenance.id"
              :maintenance
            />
            <div
              v-if="!pastMaintenance.length"
              class="flex min-h-52 flex-1 items-center justify-center"
            >
              <div class="flex items-center space-x-2">
                <XIcon :size="18" class="text-red-500" />
                <span> No maintenance records found </span>
              </div>
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
          <CardContent class="flex flex-col space-y-2">
            <MaintenanceCard
              v-for="maintenance of todayMaintenance"
              :key="maintenance.id"
              :maintenance
            />
            <div
              v-if="todayMaintenance.length === 0"
              class="flex min-h-52 flex-1 items-center justify-center"
            >
              <div class="flex items-center space-x-2">
                <XIcon :size="18" class="text-red-500" />
                <span> No maintenance scheduled for today </span>
              </div>
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
          <CardContent class="flex flex-col space-y-2">
            <MaintenanceCard
              v-for="maintenance of upcomingMaintenance"
              :key="maintenance.id"
              :maintenance
            />
            <div
              v-if="!upcomingMaintenance.length"
              class="flex min-h-52 flex-1 items-center justify-center"
            >
              <div class="flex items-center space-x-2">
                <XIcon :size="18" class="text-red-500" />
                <span> No upcoming maintenance scheduled </span>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>
    </template>
  </AuthenticatedLayout>
</template>
