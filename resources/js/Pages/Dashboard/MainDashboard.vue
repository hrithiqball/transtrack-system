<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ChartCard from '@/Pages/Dashboard/Partials/ChartCard.vue';
import MapCard from '@/Pages/Dashboard/Partials/MapCard.vue';
import { Head } from '@inertiajs/vue3';
import CalendarCard from './Partials/CalendarCard.vue';
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <div class="space-y-4 overflow-hidden shadow-sm sm:rounded-lg">
        <MapCard />
        <CalendarCard />
        <ChartCard />
      </div>
    </template>
  </AuthenticatedLayout>
</template>
