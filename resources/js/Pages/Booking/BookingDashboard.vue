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
  DialogTrigger,
} from '@/Components/ui/dialog';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Booking } from '@/types/Booking';
import { Head, usePage } from '@inertiajs/vue3';
import BookVehicleForm from './Partials/BookVehicleForm.vue';
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/Components/ui/table';
import { ref } from 'vue';

const bookings = usePage().props.bookings as Booking[];
const openDetails = ref(false);
const currentBooking = ref<Booking | null>(null);

const handleOpenDialog = (booking: Booking) => {
  currentBooking.value = booking;
  openDetails.value = !openDetails.value;
};
</script>

<template>
  <Head title="Booking" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex flex-col">
        <div class="flex justify-between">
          <h2
            class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
          >
            Booking
          </h2>
          <Dialog>
            <DialogTrigger as-child>
              <Button variant="outline"> Book Vehicle </Button>
            </DialogTrigger>
            <DialogContent>
              <DialogHeader>
                <DialogTitle>Book Vehicle</DialogTitle>
              </DialogHeader>
              <BookVehicleForm />
            </DialogContent>
          </Dialog>
        </div>
        <div class="mt-4 flex items-center justify-center">
          <Tabs default-value="general" class="w-full">
            <TabsList class="grid w-full grid-cols-2">
              <TabsTrigger value="general"> General </TabsTrigger>
              <TabsTrigger value="approval"> Approval </TabsTrigger>
            </TabsList>
            <TabsContent value="general">
              <Card>
                <CardHeader>
                  <CardTitle>General</CardTitle>
                  <CardDescription> View your bookings here. </CardDescription>
                </CardHeader>
                <CardContent class="space-y-2">
                  <Table v-if="bookings.length > 0">
                    <TableHeader>
                      <TableRow>
                        <TableHead>ID</TableHead>
                        <TableHead>Vehicle Plate Number</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead>Notes</TableHead>
                      </TableRow>
                    </TableHeader>
                    <TableBody>
                      <TableRow v-for="booking in bookings" :key="booking.id">
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
                </CardContent>
              </Card>
            </TabsContent>
            <TabsContent value="approval">
              <Card>
                <CardHeader>
                  <CardTitle>Approval</CardTitle>
                  <CardDescription>
                    Approve incoming request for vehicle usage
                  </CardDescription>
                </CardHeader>
                <CardContent class="space-y-2">
                  <Table
                    v-if="
                      bookings.filter((b) => b.status === 'Pending').length > 0
                    "
                  >
                    <TableHeader>
                      <TableRow>
                        <TableHead>ID</TableHead>
                        <TableHead>Vehicle Plate Number</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead>Notes</TableHead>
                      </TableRow>
                    </TableHeader>
                    <TableBody>
                      <TableRow
                        v-for="booking in bookings.filter(
                          (b) => b.status === 'Pending',
                        )"
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
                        <DialogTitle>Booking Details</DialogTitle>
                        <DialogDescription>
                          {{ currentBooking?.vehicle.plateNumber }}
                        </DialogDescription>
                      </DialogHeader>
                      <Table>
                        <TableBody>
                          <TableRow>
                            <TableCell>Booking ID</TableCell>
                            <TableCell>{{ currentBooking?.id }}</TableCell>
                          </TableRow>
                          <TableRow>
                            <TableCell>Start Date</TableCell>
                            <TableCell>{{
                              currentBooking?.startDate
                            }}</TableCell>
                          </TableRow>
                          <TableRow>
                            <TableCell>End Date</TableCell>
                            <TableCell>{{ currentBooking?.endDate }}</TableCell>
                          </TableRow>
                          <TableRow>
                            <TableCell>Plate Number</TableCell>
                            <TableCell>
                              {{ currentBooking?.vehicle.plateNumber }}
                            </TableCell>
                          </TableRow>
                          <TableRow>
                            <TableCell>Booked By</TableCell>
                            <TableCell>
                              {{ currentBooking?.bookedBy.name }}
                            </TableCell>
                          </TableRow>
                          <TableRow>
                            <TableCell>Notes</TableCell>
                            <TableCell>{{ currentBooking?.notes }}</TableCell>
                          </TableRow>
                        </TableBody>
                      </Table>
                      <div class="flex flex-row-reverse gap-4">
                        <Button>Approve</Button>
                        <Button variant="destructive">Reject</Button>
                      </div>
                    </DialogContent>
                  </Dialog>
                </CardContent>
              </Card>
            </TabsContent>
          </Tabs>
        </div>
      </div>
    </template>
  </AuthenticatedLayout>
</template>
