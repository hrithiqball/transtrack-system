<script setup lang="ts">
import { MoreHorizontal } from 'lucide-vue-next';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import { Button } from '@/Components/ui/button';
import { router } from '@inertiajs/vue3';
import { Vehicle } from '@/types/Vehicle';

defineProps<{
  vehicle: Vehicle;
}>();

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
      <DropdownMenuItem @click="openDetails(vehicle.id)">
        Details
      </DropdownMenuItem>
      <DropdownMenuItem @click="editVehicle(vehicle.id)">
        Edit
      </DropdownMenuItem>
      <DropdownMenuItem class="text-red-500" @click="deleteVehicle(vehicle.id)">
        Delete
      </DropdownMenuItem>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
