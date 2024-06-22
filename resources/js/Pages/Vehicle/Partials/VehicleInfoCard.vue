<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';
import { router } from '@inertiajs/vue3';
import { Car } from 'lucide-vue-next';
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';

defineProps<{ vehicle: Vehicle }>();

const handleVisitVehicle = (id: number) => {
  router.visit(route('vehicle.detail', { id }));
};
</script>

<template>
  <Card class="" @click="handleVisitVehicle(vehicle.id)">
    <CardHeader>
      <CardTitle> Vehicle Info </CardTitle>
      <CardDescription>
        Vehicle associated with this maintenance
      </CardDescription>
    </CardHeader>
    <CardContent>
      <div class="flex flex-col space-y-2">
        <div class="flex">
          <div
            class="flex rounded-md border-2 border-white bg-black px-2 py-1 text-white shadow-lg"
          >
            <span>
              {{ vehicle.plateNumber }}
            </span>
          </div>
        </div>
        <div class="flex items-center space-x-1">
          <Car :size="18" />
          <span>{{ vehicle.brand }}</span>
          <span>{{ vehicle.model }}</span>
        </div>
      </div>
    </CardContent>
  </Card>
</template>
