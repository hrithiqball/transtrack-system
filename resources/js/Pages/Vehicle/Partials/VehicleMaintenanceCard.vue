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
import { router } from '@inertiajs/vue3';

defineProps<{ maintenances: Maintenance[] | undefined }>();

const navigateToMaintenanceDetail = (id: number) => {
  router.visit(route('maintenance.detail', { id }));
};
</script>

<template>
  <div class="flex flex-col">
    <span class="text-lg font-semibold">Maintenances</span>
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
  </div>
</template>
