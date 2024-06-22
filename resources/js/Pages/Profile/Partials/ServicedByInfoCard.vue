<script setup lang="ts">
import { Card } from '@/Components/ui/card';
import { User } from '@/types';
import { router } from '@inertiajs/vue3';
import { Mail, UserIcon } from 'lucide-vue-next';

defineProps<{ servicedBy: User }>();

const handleVisitUser = (id: number) => {
  router.visit(route('profile.detail', { id }));
};
</script>

<template>
  <Card
    class="flex cursor-pointer flex-col items-center space-y-4 rounded-lg p-4"
    @click="handleVisitUser(servicedBy.id)"
  >
    <span class="text-lg font-semibold">Service By</span>
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
  </Card>
</template>
