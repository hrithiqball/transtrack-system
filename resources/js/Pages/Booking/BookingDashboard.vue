<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
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
  </AuthenticatedLayout>
</template>
