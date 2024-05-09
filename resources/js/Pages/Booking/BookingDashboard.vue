<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/Components/ui/dialog';
import { Button } from '@/Components/ui/button';
import BookVehicleForm from './Partials/BookVehicleForm.vue';
import { Booking } from '@/types/Booking';

const bookings = usePage().props.bookings as Booking[];
</script>

<template>
  <Head title="Booking" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2
          class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
        >
          Booking
        </h2>
        <Dialog>
          <DialogTrigger as-child>
            <Button variant="outline"> Book Vehicle </Button>
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle>Book Vehicle</DialogTitle>
            </DialogHeader>
            <BookVehicleForm />
          </DialogContent>
        </Dialog>
      </div>
    </template>

    <div class="space-y-4 py-4">
      <div class="mx-auto max-w-7xl space-y-4 sm:px-4 lg:px-8">
        <div class="rounded-lg bg-white p-4 shadow dark:bg-gray-800">
          <div v-for="booking in bookings" :key="booking.id">
            {{ booking.status }}
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
