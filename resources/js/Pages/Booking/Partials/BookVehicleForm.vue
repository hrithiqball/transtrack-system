<script setup lang="ts">
import InputLabel from '@/Components/InputLabel.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const vehicleIdInput = ref<HTMLInputElement | null>(null);

const form = useForm({
  vehicleId: '',
});

const createBooking = () => {
  form.post(route('booking.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
    onError: () => {
      if (form.errors.vehicleId) {
        form.reset('vehicleId');
        vehicleIdInput.value?.focus();
      }
    },
  });
};
</script>

<template>
  <section>
    <form class="mt-4 space-y-4" @submit.prevent="createBooking">
      <div>
        <InputLabel for="vehicleId">Vehicle</InputLabel>
      </div>
      <p>{{ $page.props.vehicles }}</p>
    </form>
  </section>
</template>
