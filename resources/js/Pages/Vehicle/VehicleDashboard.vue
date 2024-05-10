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
import { columns } from './Partials/vehicle-table/vehicleColumn';
import { onMounted, ref } from 'vue';

const vehicles = usePage().props.vehicles as Vehicle[];
const data = ref<Vehicle[]>([]);

const getData = () => {
  return vehicles;
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

    <DataTable :columns :data />
  </AuthenticatedLayout>
</template>
