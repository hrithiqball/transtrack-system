<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/Components/ui/dialog';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Vehicle } from '@/types/Vehicle';
import { Head, usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import AddVehicleForm from './Partials/AddVehicleForm.vue';
import DataTable from './Partials/vehicle-table/VehicleTable.vue';
import { columns } from './Partials/vehicle-table/vehicleColumn';

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
        <Dialog
          v-if="
            $page.props.auth.user.role === 'admin' ||
            $page.props.auth.user.role === 'manager'
          "
        >
          <DialogTrigger as-child>
            <Button variant="outline">Register Vehicle</Button>
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle> Register new vehicle </DialogTitle>
            </DialogHeader>
            <!-- <AddVehicleForm /> -->
          </DialogContent>
        </Dialog>
      </div>
    </template>

    <DataTable :columns :data />
  </AuthenticatedLayout>
</template>
