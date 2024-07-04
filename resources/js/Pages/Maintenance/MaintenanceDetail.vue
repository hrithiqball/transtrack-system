<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import {
  Card,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { refreshPage } from '@/lib/utils';
import { Maintenance } from '@/types/Maintenance';
import { Head, router, usePage } from '@inertiajs/vue3';
import { format } from 'date-fns';
import { Ban, Check, CheckIcon, Trash } from 'lucide-vue-next';
import { computed } from 'vue';
import { toast } from 'vue-sonner';
import ServicedByInfoCard from '../Profile/Partials/ServicedByInfoCard.vue';
import VehicleInfoCard from '../Vehicle/Partials/VehicleInfoCard.vue';

const maintenance = usePage().props.maintenance as Maintenance;
const formattedDate = computed(() => {
  const date = new Date(maintenance.maintenanceDate);

  return {
    day: format(date, 'dd'),
    month: format(date, 'MMMM'),
    year: format(date, 'yyyy'),
  };
});

function handleMarkAsComplete() {
  router.put(
    route('maintenance.update', {
      id: maintenance.id,
      completed: true,
    }),
  );
  toast.success(`Maintenance ${maintenance.id} has been marked as completed`);
  refreshPage();
}

function handleMarkAsNotComplete() {
  router.put(
    route('maintenance.update', {
      id: maintenance.id,
      completed: false,
    }),
  );
  toast.success(
    `Maintenance ${maintenance.id} has been marked as not completed`,
  );
  refreshPage();
}

function handleDeleteMaintenance() {
  router.delete(route('maintenance.destroy', { id: maintenance.id }));
  toast.success(`Maintenance ${maintenance.id} has been deleted`);
}
</script>

<template>
  <Head title="Maintenance Detail" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <div class="flex flex-col space-y-2">
          <div class="font-semibold leading-none tracking-tight">
            Maintenance Detail
          </div>
          <div class="text-sm text-muted-foreground">
            Maintenance ID: {{ maintenance.id }}
          </div>
          <div class="flex">
            <div
              v-if="maintenance.completed"
              class="flex items-center space-x-2 rounded-sm bg-green-500 px-2 py-1 text-sm text-white"
            >
              <CheckIcon :size="14" />
              <span class="pr-1"> Maintenance is completed </span>
            </div>
            <div
              v-else
              class="flex items-center space-x-2 rounded-sm bg-red-500 px-2 py-1 text-sm text-white"
            >
              <Ban :size="14" />
              <span class="pr-1"> Maintenance is not yet completed </span>
            </div>
          </div>
          <div
            v-if="
              $page.props.auth.user.role === 'manager' ||
              $page.props.auth.user.role === 'personnel'
            "
            class="flex items-center space-x-2"
          >
            <Button
              v-if="!maintenance.completed"
              @click="handleMarkAsComplete()"
            >
              <div class="flex items-center space-x-2">
                <Check :size="18" />
                <span> Mark as Completed </span>
              </div>
            </Button>
            <Button
              v-if="maintenance.completed"
              @click="handleMarkAsNotComplete()"
            >
              <div class="flex items-center space-x-2">
                <Check :size="18" />
                <span> Mark as Not Completed </span>
              </div>
            </Button>
            <Button
              v-if="maintenance.servicedBy.id === $page.props.auth.user.id"
              variant="destructive"
            >
              <div
                class="flex items-center space-x-2"
                @click="handleDeleteMaintenance()"
              >
                <Trash :size="18" />
                <span> Delete Maintenance </span>
              </div>
            </Button>
          </div>
        </div>
        <div class="flex items-center justify-center">
          <Card
            class="my-4 flex size-24 flex-col items-center justify-center rounded-full p-6"
          >
            <span class="text-xl font-bold text-rose-500">
              {{ formattedDate.day }}
            </span>
            <span class="text-sm">{{ formattedDate.month }}</span>
            <span class="text-xs">{{ formattedDate.year }}</span>
          </Card>
        </div>
      </div>

      <div class="mt-4 grid grid-cols-2 gap-4">
        <Card class="col-span-2">
          <CardHeader>
            <CardTitle> Remarks </CardTitle>
            <CardDescription>
              {{ maintenance.remarks }}
            </CardDescription>
          </CardHeader>
        </Card>
        <VehicleInfoCard :vehicle="maintenance.vehicle" />
        <ServicedByInfoCard :serviced-by="maintenance.servicedBy" />
      </div>
    </template>
  </AuthenticatedLayout>
</template>
