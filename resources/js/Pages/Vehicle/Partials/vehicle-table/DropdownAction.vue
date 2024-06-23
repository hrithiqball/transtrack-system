<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
} from '@/Components/ui/dialog';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import CreateMaintenanceForm from '@/Pages/Maintenance/Partials/CreateMaintenanceForm.vue';
import { Vehicle } from '@/types/Vehicle';
import { router } from '@inertiajs/vue3';
import {
  MoreHorizontal,
  NotebookTabs,
  Wrench,
  TrashIcon,
  EditIcon,
} from 'lucide-vue-next';
import { ref } from 'vue';

defineProps<{ vehicle: Vehicle }>();

const vehicleId = ref(0);
const openCreateMaintenance = ref(false);

const openCreateMaintenanceDialog = (id: number) => {
  vehicleId.value = id;
  openCreateMaintenance.value = true;
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
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" class="size-8 p-0">
        <span class="sr-only">Open menu</span>
        <MoreHorizontal class="size-4" />
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuItem
        v-if="
          $page.props.auth.user.role === 'admin' ||
          $page.props.auth.user.role === 'personnel'
        "
        @click="openCreateMaintenanceDialog(vehicle.id)"
      >
        <div class="flex items-center space-x-2">
          <Wrench :size="18" />
          <span> Create Maintenance </span>
        </div>
      </DropdownMenuItem>
      <DropdownMenuItem @click="openDetails(vehicle.id)">
        <div class="flex items-center space-x-2">
          <NotebookTabs :size="18" />
          <span> Details </span>
        </div>
      </DropdownMenuItem>
      <DropdownMenuItem
        v-if="
          $page.props.auth.user.role === 'admin' ||
          $page.props.auth.user.role === 'manager'
        "
        @click="editVehicle(vehicle.id)"
      >
        <div class="flex items-center space-x-2">
          <EditIcon :size="18" />
          <span> Edit </span>
        </div>
      </DropdownMenuItem>
      <DropdownMenuItem
        v-if="
          $page.props.auth.user.role === 'admin' ||
          $page.props.auth.user.role === 'manager'
        "
        class="text-red-500"
        @click="deleteVehicle(vehicle.id)"
      >
        <div class="flex items-center space-x-2">
          <TrashIcon :size="18" />
          <span> Delete </span>
        </div>
      </DropdownMenuItem>
    </DropdownMenuContent>
  </DropdownMenu>
  <Dialog v-model:open="openCreateMaintenance">
    <DialogContent>
      <DialogHeader aria-describedby="Maintenance form">
        <DialogTitle>Create Maintenance</DialogTitle>
        <CreateMaintenanceForm :vehicle-id />
      </DialogHeader>
    </DialogContent>
  </Dialog>
</template>
