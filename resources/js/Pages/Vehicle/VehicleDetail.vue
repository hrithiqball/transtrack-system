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
          <div class="flex flex-col items-center justify-center space-y-4">
            <img
              v-if="vehicle.photo"
              :src="`/storage/${vehicle.photo}`"
              :alt="`${vehicle.brand} ${vehicle.model}`"
              class="h-60 w-96 bg-red-400 object-contain"
            />
            <template v-else>
              <div class="rounded-lg border border-dashed border-gray-300 p-4">
                No photo uploaded
              </div>
            </template>
            <div
              class="rounded-md border-2 border-solid border-white bg-black px-4 py-1 text-white"
            >
              <span class="text-2xl font-semibold">
                {{ vehicle.plateNumber }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
