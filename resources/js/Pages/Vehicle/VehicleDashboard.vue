<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import AddVehicleForm from './Partials/AddVehicleForm.vue';
import { Button } from '@/Components/ui/button';
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/Components/ui/dialog';
import { Vehicle } from '@/types/Vehicle';
import DataTable from './Partials/vehicle-table/VehicleTable.vue';
import { Payment, columns } from './Partials/vehicle-table/vehicleColumn';
import { onMounted, ref } from 'vue';

const vehicles = usePage().props.vehicles as Vehicle[];
const data = ref<Payment[]>([]);

const getData = () => {
  return [
    {
      id: '728ed52f',
      amount: 100,
      status: 'pending',
      email: 'm@example.com',
    },
    {
      id: '489e1d42',
      amount: 125,
      status: 'processing',
      email: 'example@gmail.com',
    },
  ];
};

onMounted(() => {
  data.value = getData();
});
</script>

<template>
  <Head title="Vehicle" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2
          class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
        >
          Vehicle
        </h2>
        <Dialog>
          <DialogTrigger as-child>
            <Button variant="outline">Register Vehicle</Button>
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle> Register new vehicle </DialogTitle>
            </DialogHeader>
            <AddVehicleForm />
          </DialogContent>
        </Dialog>
      </div>
    </template>

    <div class="space-y-4 py-4">
      <div class="mx-auto max-w-7xl space-y-4 sm:px-4 lg:px-8">
        <div class="rounded-lg bg-white p-4 shadow dark:bg-gray-800">
          <div v-for="vehicle in vehicles" :key="vehicle.id">
            {{ vehicle.brand }} - {{ vehicle.model }} {{ vehicle.plate_number }}
            <template v-if="vehicle.photo">
              <img
                :src="`storage/${vehicle.photo}`"
                class="size-40 object-contain"
              />
            </template>
          </div>
          <div v-if="($page.props.vehicles as Vehicle[]).length === 0">
            <p class="text-center text-gray-500 dark:text-gray-400">
              No vehicle found
            </p>
          </div>
        </div>
      </div>
    </div>
    <DataTable :columns="columns" :data="data" />
  </AuthenticatedLayout>
</template>
