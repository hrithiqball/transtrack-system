<script setup lang="ts">
import { Maintenance } from '@/types/Maintenance';
import {
  Table,
  TableBody,
  TableHeader,
  TableRow,
  TableHead,
  TableCell,
} from '@/Components/ui/table';
import { Button } from '@/Components/ui/button';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
} from '@/Components/ui/dialog';
import CreateMaintenanceForm from '@/Pages/Maintenance/Partials/CreateMaintenanceForm.vue';
import { Wrench, XIcon } from 'lucide-vue-next';
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';

defineProps<{ maintenances: Maintenance[] | undefined; vehicleId: number }>();
const openCreateMaintenance = ref(false);

const navigateToMaintenanceDetail = (id: number) => {
  router.visit(route('maintenance.detail', { id }));
};

const handleOpenCreateMaintenance = () => {
  openCreateMaintenance.value = !openCreateMaintenance.value;
};
</script>

<template>
  <Card>
    <CardHeader>
      <div class="flex justify-between">
        <CardTitle> Maintenances </CardTitle>
        <Button
          v-if="
            $page.props.auth.user.role === 'personnel' ||
            $page.props.auth.user.role === 'admin'
          "
          variant="outline"
          class="flex items-center space-x-1"
          @click="handleOpenCreateMaintenance()"
        >
          <Wrench :size="18" />
          <span> Create Maintenance </span>
        </Button>
      </div>
      <CardDescription
        >All maintenances record for this vehicle</CardDescription
      >
    </CardHeader>
    <CardContent>
      <Table>
        <TableHeader>
          <TableRow>
            <TableHead>ID</TableHead>
            <TableHead>Date</TableHead>
            <TableHead>Remarks</TableHead>
            <TableHead>Serviced By</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <template v-if="maintenances?.length">
            <TableRow
              v-for="maintenance of maintenances"
              :key="maintenance.id"
              class="cursor-pointer"
              @click="navigateToMaintenanceDetail(maintenance.id)"
            >
              <TableCell>{{ maintenance.id }}</TableCell>
              <TableCell>{{ maintenance.maintenanceDate }}</TableCell>
              <TableCell>{{ maintenance.remarks }}</TableCell>
              <TableCell>{{ maintenance.servicedBy.name }}</TableCell>
            </TableRow>
          </template>
          <template v-else>
            <TableRow>
              <TableCell colspan="4" class="h-24 text-center">
                <div class="flex items-center justify-center space-x-1">
                  <XIcon :size="18" />
                  <span> No maintenances record found </span>
                </div>
              </TableCell>
            </TableRow>
          </template>
        </TableBody>
      </Table>
      <Dialog v-model:open="openCreateMaintenance">
        <DialogContent>
          <DialogHeader>
            <DialogTitle>Create Maintenance</DialogTitle>
            <CreateMaintenanceForm :vehicleId />
          </DialogHeader>
        </DialogContent>
      </Dialog>
    </CardContent>
  </Card>
</template>
