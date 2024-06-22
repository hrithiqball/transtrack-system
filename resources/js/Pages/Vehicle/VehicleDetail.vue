<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Vehicle } from '@/types/Vehicle';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import VehicleBookingCard from './Partials/VehicleBookingCard.vue';
import VehicleDetailsCard from './Partials/VehicleDetailsCard.vue';
import VehicleImageCard from './Partials/VehicleImageCard.vue';
import VehicleMaintenanceCard from './Partials/VehicleMaintenanceCard.vue';
import VehicleMapCard from './Partials/VehicleMapCard.vue';
import { EditIcon, TrashIcon } from 'lucide-vue-next';
import { ref } from 'vue';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/Components/ui/dialog';
import { toast } from 'vue-sonner';

const vehicle = usePage().props.vehicle as Vehicle;
const vehicles = usePage().props.vehicles as Vehicle[];

const openConfirmationDeleteDialog = ref(false);

function openConfirmationDelete() {
  openConfirmationDeleteDialog.value = true;
}

function deleteVehicle(id: number) {
  router.delete(route('vehicle.destroy', { id }));
  toast.success('Vehicle deleted successfully');
}
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
        <div class="flex items-center space-x-2">
          <Link
            v-if="
              $page.props.auth.user.role === 'admin' ||
              $page.props.auth.user.role === 'manager'
            "
            :href="route('vehicle.edit', { id: vehicle.id })"
          >
            <Button variant="outline">
              <div class="flex items-center space-x-2">
                <EditIcon :size="15" />
                <span> Edit </span>
              </div>
            </Button>
          </Link>
          <Button variant="destructive" @click="openConfirmationDelete()">
            <div class="flex items-center space-x-2">
              <TrashIcon :size="15" />
              <span> Delete </span>
            </div>
          </Button>
        </div>
      </div>
      <div class="mt-4 flex flex-col space-y-4">
        <div>
          <div className="grid grid-cols-3 gap-4">
            <VehicleImageCard :photo="vehicle.photo" />
            <VehicleDetailsCard :vehicle />
            <VehicleMapCard :lat="vehicle.latitude" :lng="vehicle.longitude" />
            <VehicleMaintenanceCard
              class="col-span-3"
              :maintenances="vehicle.maintenances"
              :vehicleId="vehicle.id"
            />
            <VehicleBookingCard
              class="col-span-3"
              :bookings="vehicle.bookings || []"
              :vehicle
              :vehicles
            />
          </div>
        </div>
      </div>
    </template>

    <Dialog v-model:open="openConfirmationDeleteDialog">
      <DialogContent>
        <DialogHeader>
          <DialogTitle>
            Are you sure you want to delete this vehicle?
          </DialogTitle>
          <DialogDescription>
            This action cannot be undone. Please confirm if you want to proceed
          </DialogDescription>
        </DialogHeader>
        <div class="mt-8 flex justify-end space-x-4">
          <Button
            variant="outline"
            @click="openConfirmationDeleteDialog = false"
          >
            Cancel
          </Button>
          <Button variant="destructive" @click="deleteVehicle(vehicle.id)">
            Delete
          </Button>
        </div>
      </DialogContent>
    </Dialog>
  </AuthenticatedLayout>
</template>
