<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Button } from '@/Components/ui/button';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const brandInput = ref<HTMLInputElement | null>(null);
const modelInput = ref<HTMLInputElement | null>(null);
const plateNumberInput = ref<HTMLInputElement | null>(null);
const colorInput = ref<HTMLInputElement | null>(null);
const yearInput = ref<HTMLInputElement | null>(null);

const form = useForm({
  brand: '',
  model: '',
  plate_number: '',
  color: '#ffffff',
  year: '',
});

const createVehicle = () => {
  form.post(route('vehicle.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
    onError: () => {
      if (form.errors.brand) {
        form.reset('brand');
        brandInput.value?.focus();
      }

      if (form.errors.model) {
        form.reset('model');
        modelInput.value?.focus();
      }

      if (form.errors.plate_number) {
        form.reset('plate_number');
        plateNumberInput.value?.focus();
      }

      if (form.errors.color) {
        form.reset('color');
        colorInput.value?.focus();
      }

      if (form.errors.year) {
        form.reset('year');
        yearInput.value?.focus();
      }
    },
  });
};
</script>

<template>
  <section>
    <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Add Vehicle
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        Register new vehicle to track
      </p>
    </header>

    <form class="mt-4 space-y-4" @submit.prevent="createVehicle">
      <div>
        <InputLabel for="brand" value="Brand" />

        <TextInput
          id="model"
          v-model="form.brand"
          type="text"
          required
          autofocus
          autocomplete="car-brand"
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.brand" class="mt-2" />
      </div>

      <div>
        <InputLabel for="model" value="Model" />

        <TextInput
          id="model"
          v-model="form.model"
          type="text"
          required
          autofocus
          autocomplete="car-model"
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.model" class="mt-2" />
      </div>

      <div>
        <InputLabel for="plate_number" value="Plate Number" />

        <TextInput
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

      <div>
        <InputLabel for="color" value="Color" />

        <TextInput
          id="color"
          v-model="form.color"
          type="color"
          required
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.color" class="mt-2" />
      </div>

      <div>
        <InputLabel for="year" value="Year of Make" />

        <TextInput
          id="year"
          v-model="form.year"
          type="number"
          required
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.year" class="mt-2" />
      </div>

      <div class="flex items-center gap-4">
        <Button :disabled="form.processing">Save</Button>

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
