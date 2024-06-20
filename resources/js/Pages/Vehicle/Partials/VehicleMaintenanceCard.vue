<script setup lang="ts">
import { Maintenance } from '@/types/Maintenance';
import {
  Table,
  TableBody,
  TableHeader,
  TableRow,
  TableHead,
  TableCell,
} from '@/Components/ui/table';
import { Button } from '@/Components/ui/button';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
} from '@/Components/ui/dialog';
import CreateMaintenanceForm from '@/Pages/Maintenance/Partials/CreateMaintenanceForm.vue';

defineProps<{ maintenances: Maintenance[] | undefined; vehicleId: number }>();
const openCreateMaintenance = ref(false);

const navigateToMaintenanceDetail = (id: number) => {
  router.visit(route('maintenance.detail', { id }));
};

const handleOpenCreateMaintenance = () => {
  openCreateMaintenance.value = !openCreateMaintenance.value;
};
</script>

<template>
  <div class="flex flex-col">
    <div class="flex justify-between">
      <span class="text-lg font-semibold">Maintenances</span>
      <Button variant="outline" @click="handleOpenCreateMaintenance()">
        Create Maintenance
      </Button>
    </div>
    <Table>
      <TableHeader>
        <TableRow>
          <TableHead>ID</TableHead>
          <TableHead>Date</TableHead>
          <TableHead>Remarks</TableHead>
          <TableHead>Serviced By</TableHead>
        </TableRow>
      </TableHeader>
      <TableBody>
        <template v-if="maintenances?.length">
          <TableRow
            v-for="maintenance of maintenances"
            :key="maintenance.id"
            class="cursor-pointer"
            @click="navigateToMaintenanceDetail(maintenance.id)"
          >
            <TableCell>{{ maintenance.id }}</TableCell>
            <TableCell>{{ maintenance.maintenanceDate }}</TableCell>
            <TableCell>{{ maintenance.remarks }}</TableCell>
            <TableCell>{{ maintenance.servicedBy.name }}</TableCell>
          </TableRow>
        </template>
        <template v-else>
          <TableRow>
            <TableCell colspan="4" class="h-24 text-center">
              No maintenance record found
            </TableCell>
          </TableRow>
        </template>
      </TableBody>
    </Table>
    <Dialog v-model:open="openCreateMaintenance">
      <DialogContent>
        <DialogHeader>
          <DialogTitle>Create Maintenance</DialogTitle>
          <CreateMaintenanceForm :vehicleId />
        </DialogHeader>
      </DialogContent>
    </Dialog>
  </div>
</template>
