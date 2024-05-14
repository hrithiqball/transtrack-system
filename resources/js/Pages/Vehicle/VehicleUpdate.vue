<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';
import { InertiaForm, Head, useForm, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps<{
  vehicle: Vehicle;
  id: number;
}>();

const vehicle = usePage().props.vehicle as Vehicle;

const form: InertiaForm<{
  plate_number: string;
  latitude: string;
  longitude: string;
}> = useForm({
  plate_number: vehicle.plate_number,
  latitude: 'vehicle.latitude.toString()',
  longitude: 'vehicle.longitude.toString()',
});

const updateVehicle = () => {
  form.put(route('vehicle.update', vehicle));
};
</script>

<template>
  <Head title="Edit Vehicle" />

  <AuthenticatedLayout>
    <!-- <template #header>
      <div>
        
      </div>
    </template> -->
    <p>
      {{ vehicle.plate_number }}
    </p>
  </AuthenticatedLayout>
</template>
