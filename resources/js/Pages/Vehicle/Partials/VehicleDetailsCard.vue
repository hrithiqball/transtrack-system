<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Table, TableBody, TableCell, TableRow } from '@/Components/ui/table';
import { Vehicle } from '@/types/Vehicle';

defineProps<{
  vehicle: Vehicle;
}>();
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle>Vehicle Details</CardTitle>
    </CardHeader>
    <CardContent>
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
              <span
                v-if="vehicle.status === 'unavailable'"
                class="rounded bg-gray-800 px-2 py-1 text-white"
              >
                Unavailable
              </span>
              <span
                v-else-if="vehicle.status === 'available'"
                class="rounded bg-green-800 px-2 py-1 text-white"
              >
                Available
              </span>
              <span
                v-else-if="vehicle.status === 'in_use'"
                class="rounded bg-yellow-800 px-2 py-1 text-white"
              >
                In Use
              </span>
              <span
                v-else-if="vehicle.status === 'maintenance'"
                class="rounded bg-orange-800 px-2 py-1 text-white"
              >
                Maintenance
              </span>
              <span v-else class="rounded bg-gray-800 px-2 py-1 text-white">
                N/A
              </span>
            </TableCell>
          </TableRow>
        </TableBody>
      </Table>
    </CardContent>
  </Card>
</template>
