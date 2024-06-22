<script setup lang="ts">
import { Booking } from '@/types/Booking';
import { Table, TableBody, TableRow, TableCell } from '@/Components/ui/table';

defineProps<{ booking: Booking }>();
</script>

<template>
  <Table>
    <TableBody>
      <TableRow>
        <TableCell> Booking ID </TableCell>
        <TableCell>{{ booking.id }}</TableCell>
      </TableRow>
      <TableRow>
        <TableCell>Start Date</TableCell>
        <TableCell>{{ booking.startDate }}</TableCell>
      </TableRow>
      <TableRow>
        <TableCell> End Date </TableCell>
        <TableCell>{{ booking.endDate }}</TableCell>
      </TableRow>
      <TableRow>
        <TableCell> Plate Number </TableCell>
        <TableCell>
          {{ booking.vehicle.plateNumber }}
        </TableCell>
      </TableRow>
      <TableRow>
        <TableCell> Booked By </TableCell>
        <TableCell>
          {{ booking.bookedBy.name }}
        </TableCell>
      </TableRow>
      <TableRow>
        <TableCell> Notes </TableCell>
        <TableCell>{{ booking.notes }}</TableCell>
      </TableRow>
      <TableRow>
        <TableCell> Status </TableCell>
        <TableCell
          v-if="booking.status === 'Approved'"
          class="font-semibold text-green-500"
        >
          {{ booking.status }}
        </TableCell>
        <TableCell
          v-else-if="booking.status === 'Rejected'"
          class="font-semibold text-red-500"
        >
          {{ booking.status }}
        </TableCell>
        <TableCell
          v-else-if="booking.status === 'Pending'"
          class="font-semibold text-yellow-500"
        >
          {{ booking.status }}
        </TableCell>
      </TableRow>
    </TableBody>
  </Table>
</template>
