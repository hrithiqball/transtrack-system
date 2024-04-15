<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const brandInput = ref<HTMLInputElement | null>(null);

const form = useForm({
  brand: '',
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
    },
  });
};
</script>

<template>
  <section>
    <header>
      <h2>Add Vehicle</h2>

      <p>Register new vehicle to track</p>
    </header>

    <form @submit.prevent="createVehicle">
      <div>
        <InputLabel for="brand" value="Brand" />

        <input
          id="brand"
          ref="brandInput"
          v-model="form.brand"
          type="text"
          autocomplete="car-brand"
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.brand" class="mt-2" />
      </div>

      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="form.processing"> Save </PrimaryButton>

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
