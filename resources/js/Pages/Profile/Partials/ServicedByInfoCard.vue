<script setup lang="ts">
import { User } from '@/types';
import { Mail, UserIcon } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';

defineProps<{ servicedBy: User }>();

const handleVisitUser = (id: number) => {
  router.visit(route('profile.detail', { id }));
};
</script>

<template>
  <div
    class="flex cursor-pointer flex-col items-center space-y-4 rounded-lg bg-slate-200 p-4 dark:bg-slate-700"
    @click="handleVisitUser(servicedBy.id)"
  >
    <span class="text-lg font-semibold">Serviced By</span>
    <div
      class="flex size-20 items-center justify-center rounded-full bg-slate-300 dark:bg-slate-800"
    >
      {{ servicedBy.name.charAt(0).toUpperCase() }}
    </div>
    <div class="flex flex-col text-center">
      <span>
        <div class="flex items-center space-x-2">
          <UserIcon :size="18" />
          <span>
            {{ servicedBy.name }}
          </span>
        </div>
      </span>
      <a
        :href="`mailto:${servicedBy.email}`"
        class="flex cursor-pointer items-center space-x-2 hover:text-blue-500 hover:underline hover:underline-offset-4"
      >
        <Mail :size="18" />
        <span>
          {{ servicedBy.email }}
        </span>
      </a>
      <div class="mt-2">
        <span class="rounded-lg bg-slate-300 px-2 py-1 dark:bg-slate-800">
          {{ servicedBy.role.toUpperCase() }}
        </span>
      </div>
    </div>
  </div>
</template>
