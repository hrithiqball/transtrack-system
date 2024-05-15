<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Booking } from '@/types/Booking';

const bookings = usePage().props.bookings as Booking[];
</script>

<template>
  <Head title="Admin" />

  <AuthenticatedLayout>
    <div>
      <div class="space-y-4 py-4">
        <div class="mx-auto max-w-7xl space-y-4 sm:px-4 lg:px-8">
          <div class="rounded-lg bg-white p-4 shadow dark:bg-gray-800">
            <h3 class="text-lg font-semibold">Booking Request</h3>
            <div v-if="bookings.length > 0" class="flex flex-col">
              <div v-for="booking of bookings" :key="booking.id">
                {{ booking.notes }}
              </div>
            </div>
            <template v-else>
              <div class="text-center text-gray-500 dark:text-gray-400">
                No bookings found
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
