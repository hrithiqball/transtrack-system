<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import AddVehicleForm from './Partials/AddVehicleForm.vue';
import { usePage } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/Components/ui/dialog';
import { Vehicle } from '@/types/Vehicle';

const { vehicles } = usePage().props as unknown as { vehicles: Vehicle[] };
</script>

<template>
  <Head title="Vehicle" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2
          class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
        >
          Vehicle
        </h2>
        <Dialog>
          <DialogTrigger as-child>
            <Button variant="outline">Register Vehicle</Button>
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle> Register new vehicle </DialogTitle>
            </DialogHeader>
            <AddVehicleForm />
          </DialogContent>
        </Dialog>
      </div>
    </template>

    <div class="space-y-4 py-4">
      <div class="mx-auto max-w-7xl space-y-4 sm:px-4 lg:px-8">
        <div class="rounded-lg bg-white p-4 shadow dark:bg-gray-800">
          <div v-for="vehicle in vehicles" :key="vehicle.id">
            {{ vehicle.brand }} - {{ vehicle.model }} {{ vehicle.plate_number }}
          </div>
          <div v-if="vehicles.length === 0">
            <p class="text-center text-gray-500 dark:text-gray-400">
              No vehicle found
            </p>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
