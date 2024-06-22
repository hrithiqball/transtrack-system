<script setup lang="ts">
import { Button } from '@/Components/ui/button';
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
import BookVehicleForm from '@/Pages/Booking/Partials/BookVehicleForm.vue';
import BookingDetailsDialog from '@/Pages/Booking/Partials/BookingDetailsDiaolog.vue';
import { Booking } from '@/types/Booking';
import { Vehicle } from '@/types/Vehicle';
import { NotebookPen, XIcon } from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps<{
  bookings: Booking[];
  vehicle: Vehicle;
  vehicles: Vehicle[];
}>();

const openBookVehicle = ref(false);
const openDetailsDialog = ref(false);
const bookingRef = ref<Booking | null>(null);

function handleOpenBooking() {
  openBookVehicle.value = !openBookVehicle.value;
}

function openDetails(booking: Booking) {
  const bookingWithVehicle = { ...booking, vehicle: props.vehicle };
  bookingRef.value = bookingWithVehicle;
  openDetailsDialog.value = !openDetailsDialog.value;
}
</script>

<template>
  <Card>
    <CardHeader>
      <div class="flex justify-between">
        <CardTitle> Bookings </CardTitle>
        <Button
          class="flex items-center space-x-1"
          @click="handleOpenBooking()"
        >
          <NotebookPen :size="18" />
          <span> Book </span>
        </Button>
      </div>
      <CardDescription>All bookings of this vehicle</CardDescription>
    </CardHeader>
    <CardContent>
      <Table>
        <TableHeader>
          <TableHead>ID</TableHead>
          <TableHead>Start Date</TableHead>
          <TableHead>End Date</TableHead>
          <TableHead>Booked By</TableHead>
          <TableHead>Status</TableHead>
          <TableHead>Notes</TableHead>
        </TableHeader>
        <TableBody>
          <template v-if="bookings.length > 0">
            <TableRow
              v-for="booking of bookings"
              :key="booking.id"
              class="cursor-pointer"
              @click="openDetails(booking)"
            >
              <TableCell>{{ booking.id }}</TableCell>
              <TableCell>{{ booking.startDate }}</TableCell>
              <TableCell>{{ booking.endDate }}</TableCell>
              <TableCell>{{ booking.bookedBy.name }}</TableCell>
              <TableCell>{{ booking.status }}</TableCell>
              <TableCell>{{ booking.notes }}</TableCell>
            </TableRow>
          </template>
          <template v-else>
            <TableRow>
              <TableCell colspan="6" class="h-24 text-center">
                <div class="flex items-center justify-center space-x-1">
                  <XIcon :size="18" />
                  <span> No bookings record found </span>
                </div>
              </TableCell>
            </TableRow>
          </template>
        </TableBody>
      </Table>
      <Dialog v-model:open="openBookVehicle">
        <DialogContent>
          <DialogHeader>
            <DialogTitle>Book Vehicle</DialogTitle>
            <DialogDescription>
              Book vehicle for usage of this vehicle
            </DialogDescription>
            <BookVehicleForm :vehicles :vehicleId="vehicle.id" />
          </DialogHeader>
        </DialogContent>
      </Dialog>
      <Dialog v-if="bookingRef" v-model:open="openDetailsDialog">
        <DialogContent>
          <DialogHeader>
            <DialogTitle>Booking Details</DialogTitle>
            <BookingDetailsDialog :booking="bookingRef" />
          </DialogHeader>
        </DialogContent>
      </Dialog>
    </CardContent>
  </Card>
</template>
