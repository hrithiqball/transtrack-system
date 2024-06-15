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
    <div class="flex items-center justify-center">
      <div
        class="rounded-md border-2 border-solid border-white bg-black px-4 py-1 text-white"
      >
        <span class="text-xl font-semibold">
          {{ vehicle.plateNumber }}
        </span>
      </div>
    </div>
    <div class="flex flex-col">
      <Table>
        <TableBody>
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
            <TableCell>Brand</TableCell>
            <TableCell>{{ vehicle.brand }}</TableCell>
          </TableRow>
          <TableRow>
            <TableCell>Model</TableCell>
            <TableCell>{{ vehicle.model }}</TableCell>
          </TableRow>
          <TableRow>
            <TableCell>Year of Make</TableCell>
            <TableCell>{{ vehicle.year }}</TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </div>
  </div>
</template>
