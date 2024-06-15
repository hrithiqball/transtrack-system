<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/Components/ui/dialog';
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/Components/ui/table';
import { Booking } from '@/types/Booking';
import { ref } from 'vue';

defineProps<{
  bookings: Booking[];
}>();

const openDetails = ref(false);
const currentBooking = ref<Booking | null>(null);

const handleOpenDialog = (booking: Booking) => {
  currentBooking.value = booking;
  openDetails.value = !openDetails.value;
};
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle> General </CardTitle>
      <CardDescription> View your bookings here. </CardDescription>
    </CardHeader>
    <CardContent class="space-y-2">
      <Table v-if="bookings.length > 0">
        <TableHeader>
          <TableRow>
            <TableHead> ID </TableHead>
            <TableHead> Vehicle Plate Number </TableHead>
            <TableHead> Status </TableHead>
            <TableHead> Notes </TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow
            v-for="booking in bookings"
            :key="booking.id"
            class="cursor-pointer"
            @click="handleOpenDialog(booking)"
          >
            <TableCell>{{ booking.id }}</TableCell>
            <TableCell>{{ booking.vehicle.plateNumber }}</TableCell>
            <TableCell>{{ booking.status }}</TableCell>
            <TableCell>{{ booking.notes }}</TableCell>
          </TableRow>
        </TableBody>
      </Table>
      <template v-else>
        <div class="text-center text-gray-500 dark:text-gray-400">
          No bookings found
        </div>
      </template>
      <Dialog v-model:open="openDetails">
        <DialogContent>
          <DialogHeader>
            <DialogTitle> Booking Details </DialogTitle>
            <DialogDescription>
              {{ currentBooking?.vehicle.plateNumber }}
            </DialogDescription>
          </DialogHeader>
          <Table>
            <TableBody>
              <TableRow>
                <TableCell> Booking ID </TableCell>
                <TableCell>{{ currentBooking?.id }}</TableCell>
              </TableRow>
              <TableRow>
                <TableCell>Start Date</TableCell>
                <TableCell>{{ currentBooking?.startDate }}</TableCell>
              </TableRow>
              <TableRow>
                <TableCell> End Date </TableCell>
                <TableCell>{{ currentBooking?.endDate }}</TableCell>
              </TableRow>
              <TableRow>
                <TableCell> Plate Number </TableCell>
                <TableCell>
                  {{ currentBooking?.vehicle.plateNumber }}
                </TableCell>
              </TableRow>
              <TableRow>
                <TableCell> Booked By </TableCell>
                <TableCell>
                  {{ currentBooking?.bookedBy.name }}
                </TableCell>
              </TableRow>
              <TableRow>
                <TableCell> Notes </TableCell>
                <TableCell>{{ currentBooking?.notes }}</TableCell>
              </TableRow>
              <TableRow>
                <TableCell> Status </TableCell>
                <TableCell>{{ currentBooking?.status }}</TableCell>
              </TableRow>
            </TableBody>
          </Table>
        </DialogContent>
      </Dialog>
    </CardContent>
  </Card>
</template>
