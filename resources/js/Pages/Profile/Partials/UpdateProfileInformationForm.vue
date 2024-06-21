<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps<{
  status?: string;
}>();

const user = usePage().props.auth.user;

const form = useForm({
  name: user.name,
  email: user.email,
});
</script>

<template>
  <section>
    <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Profile Information
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        Update your account's profile information and email address.
      </p>
    </header>

    <form
      class="mt-4 space-y-4"
      @submit.prevent="form.patch(route('profile.update'))"
    >
      <div class="flex flex-col space-y-3">
        <Label>Role</Label>
        <div>
          <span
            class="rounded-lg bg-violet-500 px-2 py-1 font-semibold text-white"
          >
            {{ user.role.toUpperCase() }}
          </span>
        </div>
      </div>

      <div>
        <Label for="name"> Name </Label>

        <Input
          id="name"
          v-model="form.name"
          type="text"
          class="mt-1 block w-full dark:bg-input"
          required
          autofocus
          autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <div>
        <Label for="email"> Email </Label>

        <Input
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full dark:bg-input"
          required
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
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
