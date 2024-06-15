<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/Components/ui/dialog';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Booking } from '@/types/Booking';
import { Vehicle } from '@/types/Vehicle';
import { Head, InertiaForm, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue-sonner';
import BookVehicleForm from './Partials/BookVehicleForm.vue';
import BookingApprovalTable from './Partials/BookingApprovalTable.vue';
import BookingGeneralTable from './Partials/BookingGeneralTable.vue';

const bookings = usePage().props.bookings as Booking[];
const vehicles = usePage().props.vehicles as Vehicle[];
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

  form.put(route('booking.update', { booking: currentBooking.value }), {
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

  form.put(route('booking.update', { booking: currentBooking.value }), {
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
                <DialogTitle> Book Vehicle </DialogTitle>
              </DialogHeader>
              <BookVehicleForm :vehicles />
            </DialogContent>
          </Dialog>
        </div>
        <div
          v-if="
            $page.props.auth.user.role === 'admin' ||
            $page.props.auth.user.role === 'manager'
          "
          class="mt-4 flex items-center justify-center"
        >
          <Tabs default-value="general" class="w-full">
            <TabsList class="grid w-full grid-cols-2">
              <TabsTrigger value="general"> General </TabsTrigger>
              <TabsTrigger value="approval"> Approval </TabsTrigger>
            </TabsList>
            <TabsContent value="general">
              <BookingGeneralTable :bookings />
            </TabsContent>
            <TabsContent value="approval">
              <BookingApprovalTable :bookings />
            </TabsContent>
          </Tabs>
        </div>
        <div v-else class="mt-4">
          <BookingGeneralTable :bookings />
        </div>
      </div>
    </template>
  </AuthenticatedLayout>
</template>
