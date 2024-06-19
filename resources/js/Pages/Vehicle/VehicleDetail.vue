<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Vehicle } from '@/types/Vehicle';
import { Head, Link, usePage } from '@inertiajs/vue3';
import VehicleDetailsCard from './Partials/VehicleDetailsCard.vue';
import VehicleImageCard from './Partials/VehicleImageCard.vue';
import VehicleMaintenanceCard from './Partials/VehicleMaintenanceCard.vue';
import VehicleMapCard from './Partials/VehicleMapCard.vue';
import { ref } from 'vue';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/Components/ui/dialog';
import BookVehicleForm from '../Booking/Partials/BookVehicleForm.vue';

const vehicle = usePage().props.vehicle as Vehicle;
const vehicles = usePage().props.vehicles as Vehicle[];

const openBooking = ref(false);

const handleOpenBooking = () => {
  openBooking.value = !openBooking.value;
};
</script>

<template>
  <Head title="Vehicle Details" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <div class="flex items-center justify-center">
          <div
            class="rounded-md border-2 border-solid border-white bg-black px-4 py-1 text-white shadow-lg"
          >
            <span class="text-xl font-semibold">
              {{ vehicle.plateNumber }}
            </span>
          </div>
        </div>
        <div class="flex space-x-2">
          <Button @click="handleOpenBooking()"> Book </Button>
          <Link
            v-if="
              $page.props.auth.user.role === 'admin' ||
              $page.props.auth.user.role === 'manager'
            "
            :href="route('vehicle.edit', { id: vehicle.id })"
          >
            <Button variant="outline"> Edit </Button>
          </Link>
        </div>
      </div>
    </template>
    <Dialog v-model:open="openBooking">
      <DialogContent>
        <DialogHeader>
          <DialogTitle> Booking Details </DialogTitle>
          <DialogDescription>{{ vehicle.plateNumber }}</DialogDescription>
        </DialogHeader>
        <BookVehicleForm :vehicles :vehicleId="vehicle.id" />
      </DialogContent>
    </Dialog>
    <div class="py-12">
      <div class="mx-auto max-w-7xl space-y-4 sm:px-6 lg:px-8">
        <div
          class="overflow-hidden bg-white p-4 shadow-sm dark:bg-gray-800 sm:rounded-lg"
        >
          <div className="grid grid-cols-3 gap-4 h-[250px]">
            <VehicleImageCard :photo="vehicle.photo" />
            <VehicleDetailsCard :vehicle />
            <VehicleMapCard :lat="vehicle.latitude" :lng="vehicle.longitude" />
          </div>
        </div>
        <div
          class="overflow-hidden bg-white p-4 shadow-sm dark:bg-gray-800 sm:rounded-lg"
        >
          <VehicleMaintenanceCard
            :maintenances="vehicle.maintenances"
            :vehicleId="vehicle.id"
          />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
