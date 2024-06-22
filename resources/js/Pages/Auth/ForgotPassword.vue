<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps<{
  status?: string;
}>();

const form = useForm({
  email: '',
});

const submit = () => {
  form.post(route('password.email'));
};
</script>

<template>
  <GuestLayout>
    <Head title="Forgot Password" />

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
      Forgot your password? No problem. Just let us know your email address and
      we will email you a password reset link that will allow you to choose a
      new one.
    </div>

    <div
      v-if="status"
      class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
    >
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <Label for="email">Email</Label>

        <Input
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full dark:bg-input"
          required
          autofocus
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4 flex items-center justify-end">
        <button
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Email Password Reset Link
        </button>
      </div>
    </form>
  </GuestLayout>
</template>
