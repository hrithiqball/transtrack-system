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
import { BadgePlus } from 'lucide-vue-next';

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
      <div
        v-if="$page.props.auth.user.role === 'manager'"
        class="flex justify-end"
      >
        <Dialog>
          <DialogTrigger as-child>
            <Button variant="outline">
              <div class="flex items-center space-x-2">
                <BadgePlus :size="18" />
                <span> Register Vehicle </span>
              </div>
            </Button>
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle> Register new vehicle </DialogTitle>
            </DialogHeader>
            <AddVehicleForm />
          </DialogContent>
        </Dialog>
      </div>
      <DataTable :columns :data />
    </template>
  </AuthenticatedLayout>
</template>
