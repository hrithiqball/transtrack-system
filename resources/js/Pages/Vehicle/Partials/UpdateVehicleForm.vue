<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select';
import { Vehicle } from '@/types/Vehicle';
import { InertiaForm, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue-sonner';

const vehicle = usePage().props.vehicle as Vehicle;
const plateNumberInput = ref<HTMLInputElement | null>(null);

const form: InertiaForm<{
  plate_number: string;
  color: string;
  status: string;
  latitude: number;
  longitude: number;
}> = useForm({
  plate_number: vehicle.plateNumber,
  color: vehicle.color,
  status: vehicle.status ?? 'na',
  latitude: vehicle.latitude,
  longitude: vehicle.longitude,
});

const updateVehicle = () => {
  form.put(route('vehicle.update', { id: vehicle.id }), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success('Vehicle successfully updated.');
      form.reset();
    },
    onError: (e) => {
      console.error(e);
      if (form.errors.plate_number) {
        form.reset('plate_number');
        plateNumberInput.value?.focus();
      }
    },
  });
};
</script>

<template>
  <section class="mx-8">
    <form class="mt-4 space-y-4" @submit.prevent="updateVehicle">
      <div>
        <Label for="plate_number">Plate Number</Label>
        <Input
          id="plate_number"
          v-model="form.plate_number"
          type="text"
          required
          autofocus
          autocomplete="plate-number"
          class="mt-1 block w-full dark:bg-input"
        />
        <InputError :message="form.errors.plate_number" class="mt-2" />
      </div>

      <div>
        <Label for="color">Color</Label>
        <Input
          id="color"
          v-model="form.color"
          type="color"
          class="dark:bg-input"
        />
      </div>

      <div>
        <Label for="status">Status</Label>
        <Select v-model="form.status" class="dark:bg-input">
          <SelectTrigger>
            <SelectValue placeholder="Vehicle Status" />
          </SelectTrigger>
          <SelectContent>
            <SelectGroup>
              <SelectItem value="available">Available</SelectItem>
              <SelectItem value="maintenance">Maintenance</SelectItem>
              <SelectItem value="in_use">In Use</SelectItem>
              <SelectItem value="unavailable">Unavailable</SelectItem>
              <SelectItem value="na">N/A</SelectItem>
            </SelectGroup>
          </SelectContent>
        </Select>
      </div>

      <div class="flex items-center gap-4">
        <Button variant="outline" :disabled="form.processing">Save</Button>

        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
        >
          <p
            v-if="form.recentlySuccessful"
            class="text-sm text-gray-600 dark:text-gray-400"
          >
            Saved.
          </p>
        </Transition>
      </div>
    </form>
  </section>
</template>
