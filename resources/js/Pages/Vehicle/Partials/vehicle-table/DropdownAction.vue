<script setup lang="ts">
import { MoreHorizontal } from 'lucide-vue-next';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import {
  Dialog,
  DialogTrigger,
  DialogContent,
  DialogHeader,
  DialogTitle,
} from '@/Components/ui/dialog';
import { Button } from '@/Components/ui/button';
import { router } from '@inertiajs/vue3';
import { Vehicle } from '@/types/Vehicle';
import CreateMaintenanceForm from '@/Pages/Maintenance/Partials/CreateMaintenanceForm.vue';
import { ref } from 'vue';

defineProps<{
  vehicle: Vehicle;
}>();

const vehicleId = ref(0);

const openCreateMaintenanceDialog = (id: number) => {
  vehicleId.value = id;
};

const openDetails = (id: number) => {
  router.visit(route('vehicle.detail', { id }));
};

const editVehicle = (id: number) => {
  router.visit(route('vehicle.edit', { id }));
};

const deleteVehicle = (id: number) => {
  if (confirm('Are you sure you want to delete this vehicle?')) {
    router.delete(route('vehicle.destroy', { id }));
  }
};
</script>

<template>
  <Dialog>
    <DropdownMenu>
      <DropdownMenuTrigger as-child>
        <Button variant="ghost" class="size-8 p-0">
          <span class="sr-only">Open menu</span>
          <MoreHorizontal class="size-4" />
        </Button>
      </DropdownMenuTrigger>
      <DropdownMenuContent align="end">
        <DialogTrigger as-child>
          <DropdownMenuItem @click="openCreateMaintenanceDialog(vehicle.id)">
            Create Maintenance
          </DropdownMenuItem>
        </DialogTrigger>
        <DropdownMenuItem @click="openDetails(vehicle.id)">
          Details
        </DropdownMenuItem>
        <DropdownMenuItem @click="editVehicle(vehicle.id)">
          Edit
        </DropdownMenuItem>
        <DropdownMenuItem
          class="text-red-500"
          @click="deleteVehicle(vehicle.id)"
        >
          Delete
        </DropdownMenuItem>
      </DropdownMenuContent>
    </DropdownMenu>
    <DialogContent>
      <DialogHeader aria-describedby="Maintenance form">
        <DialogTitle>Create Maintenance</DialogTitle>
        <CreateMaintenanceForm :vehicleId />
      </DialogHeader>
    </DialogContent>
  </Dialog>
</template>
