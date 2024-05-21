<script setup lang="ts">
import { Input } from '@/Components/ui/input';
import { Button } from '@/Components/ui/button';
import { Vehicle } from '@/types/Vehicle';
import { InertiaForm, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Label } from '@/Components/ui/label';
import InputError from '@/Components/InputError.vue';

defineProps<{
  vehicle: Vehicle;
}>();

const vehicle = usePage().props.vehicle as Vehicle;
const plateNumberInput = ref<HTMLInputElement | null>(null);

const form: InertiaForm<{
  plate_number: string;
}> = useForm({
  plate_number: vehicle.plateNumber,
});

const updateVehicle = () => {
  form.put(route('vehicle.update', { vehicle }), {
    preserveScroll: true,
    onSuccess: () => {
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
          class="mt-1 block w-full"
        />
        <InputError :message="form.errors.plate_number" class="mt-2" />
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
