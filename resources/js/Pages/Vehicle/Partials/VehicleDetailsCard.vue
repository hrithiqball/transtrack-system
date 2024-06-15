<script setup lang="ts">
import { Table, TableBody, TableCell, TableRow } from '@/Components/ui/table';
import { Vehicle } from '@/types/Vehicle';

defineProps<{
  vehicle: Vehicle;
}>();
</script>

<template>
  <div
    class="flex min-h-60 flex-1 flex-col space-y-4 rounded-lg bg-slate-200 p-4 dark:bg-slate-500"
  >
    <div class="flex flex-col">
      <Table>
        <TableBody>
          <TableRow>
            <TableCell>Brand</TableCell>
            <TableCell>{{ vehicle.brand }}</TableCell>
          </TableRow>
          <TableRow>
            <TableCell>Model</TableCell>
            <TableCell>{{ vehicle.model }}</TableCell>
          </TableRow>
          <TableRow>
            <TableCell> Color </TableCell>
            <TableCell>
              <div
                class="size-4 rounded-full"
                :style="{ backgroundColor: vehicle.color }"
              ></div>
            </TableCell>
          </TableRow>
          <TableRow>
            <TableCell>Year of Make</TableCell>
            <TableCell>{{ vehicle.year }}</TableCell>
          </TableRow>
          <TableRow>
            <TableCell>Status</TableCell>
            <TableCell>
              {{ vehicle.status === null ? 'N/A' : vehicle.status }}
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </div>
</template>
