<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import { Label } from '@/Components/ui/label';
import { Input } from '@/Components/ui/input';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
  email: string;
  token: string;
}>();

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('password.store'), {
    onFinish: () => {
      form.reset('password', 'password_confirmation');
    },
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Reset Password" />

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

      <div class="mt-4">
        <Label for="password"> Password </Label>

        <Input
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full dark:bg-input"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4">
        <Label for="password_confirmation"> Confirm Password </Label>

        <Input
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <div class="mt-4 flex items-center justify-end">
        <button
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Reset Password
        </button>
      </div>
    </form>
  </GuestLayout>
</template>
