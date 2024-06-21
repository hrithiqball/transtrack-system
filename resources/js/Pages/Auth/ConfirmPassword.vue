<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
  password: '',
});

const submit = () => {
  form.post(route('password.confirm'), {
    onFinish: () => {
      form.reset();
    },
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Confirm Password" />

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
      This is a secure area of the application. Please confirm your password
      before continuing.
    </div>

    <form @submit.prevent="submit">
      <div>
        <Label for="password"> Password </Label>
        <Input
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full dark:bg-input"
          required
          autocomplete="current-password"
          autofocus
        />
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4 flex justify-end">
        <button
          class="ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Confirm
        </button>
      </div>
    </form>
  </GuestLayout>
</template>
