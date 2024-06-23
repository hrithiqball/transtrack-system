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
import { Booking } from '@/types/Booking';
import { InertiaForm, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue-sonner';

defineProps<{
  bookings: Booking[];
}>();

const openDetails = ref(false);
const currentBooking = ref<Booking | null>(null);

const handleOpenDialog = (booking: Booking) => {
  currentBooking.value = booking;
  openDetails.value = !openDetails.value;
};

const approveBooking = () => {
  const form: InertiaForm<{ status: string }> = useForm({
    status: 'Approved',
  });

  form.put(route('booking.update', { id: currentBooking.value?.id }), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      openDetails.value = false;
      toast.success('Booking approved successfully');
    },
    onError: (e) => {
      console.error(e);
    },
  });
};

const rejectBooking = () => {
  const form: InertiaForm<{ status: string }> = useForm({
    status: 'Rejected',
  });

  form.put(route('booking.update', { id: currentBooking.value?.id }), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      openDetails.value = false;
      toast.success('Booking rejected successfully');
    },
    onError: (e) => {
      console.error(e);
    },
  });
};
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle> Approval </CardTitle>
      <CardDescription>
        Approve incoming request for vehicle usage
      </CardDescription>
    </CardHeader>
    <CardContent class="space-y-2">
      <Table v-if="bookings.filter((b) => b.status === 'Pending').length > 0">
        <TableHeader>
          <TableRow>
            <TableHead> ID </TableHead>
            <TableHead> Vehicle Plate Number </TableHead>
            <TableHead> Notes </TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <TableRow
            v-for="booking in bookings.filter((b) => b.status === 'Pending')"
            :key="booking.id"
            class="cursor-pointer"
            @click="handleOpenDialog(booking)"
          >
            <TableCell>{{ booking.id }}</TableCell>
            <TableCell>{{ booking.vehicle.plateNumber }}</TableCell>
            <TableCell>{{ booking.notes }}</TableCell>
          </TableRow>
        </TableBody>
      </Table>
      <template v-else>
        <div class="text-center text-gray-500 dark:text-gray-400">
          No bookings approval needed for now
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
            </TableBody>
          </Table>
          <div class="flex flex-row-reverse gap-4">
            <Button @click="approveBooking()"> Approve </Button>
            <Button variant="destructive" @click="rejectBooking()">
              Reject
            </Button>
          </div>
        </DialogContent>
      </Dialog>
    </CardContent>
  </Card>
</template>
