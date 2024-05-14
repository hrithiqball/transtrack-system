<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Vehicle } from '@/types/Vehicle';
import { usePage, Head } from '@inertiajs/vue3';

defineProps<{ vehicle: Vehicle }>();

const vehicle = usePage().props.vehicle as Vehicle;
</script>

<template>
  <Head title="Vehicle Details" />

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
          class="overflow-hidden bg-white p-4 shadow-sm dark:bg-gray-800 sm:rounded-lg"
        >
          <div class="flex items-center justify-center">
            <img
              v-if="vehicle.photo"
              :src="`/storage/${vehicle.photo}`"
              :alt="`${vehicle.brand} ${vehicle.model}`"
              class="h-60 w-96 bg-red-400 object-contain"
            />
            <template v-else>
              <div>no pic</div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
