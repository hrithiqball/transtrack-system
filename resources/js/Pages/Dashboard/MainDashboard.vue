<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Map from '@/Pages/Dashboard/Partials/Map.vue';
import { Head } from '@inertiajs/vue3';
import Calendar from './Partials/Calendar.vue';
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
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
          class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg"
        >
          <Map />
          <Calendar />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
