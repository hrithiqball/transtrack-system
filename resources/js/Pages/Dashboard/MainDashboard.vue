<script setup lang="ts">
import { Card, CardContent } from '@/Components/ui/card';
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
      <h2
        class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
      >
        Dashboard
      </h2>
      <Card class="mt-4">
        <CardContent class="p-6">
          <div class="">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
              <MapCard />
              <CalendarCard />
              <ChartCard />
            </div>
          </div>
        </CardContent>
      </Card>
    </template>
  </AuthenticatedLayout>
</template>
