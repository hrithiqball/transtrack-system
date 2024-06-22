<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardHeader } from '@/Components/ui/card';
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
import { Head, usePage } from '@inertiajs/vue3';
import BookVehicleForm from './Partials/BookVehicleForm.vue';
import BookingApprovalTable from './Partials/BookingApprovalTable.vue';
import BookingGeneralTable from './Partials/BookingGeneralTable.vue';

const bookings = usePage().props.bookings as Booking[];
const vehicles = usePage().props.vehicles as Vehicle[];
</script>

<template>
  <Head title="Booking" />

  <AuthenticatedLayout>
    <template #header>
      <Card class="flex flex-col">
        <CardHeader>
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
        </CardHeader>
        <CardContent>
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
        </CardContent>
      </Card>
    </template>
  </AuthenticatedLayout>
</template>
