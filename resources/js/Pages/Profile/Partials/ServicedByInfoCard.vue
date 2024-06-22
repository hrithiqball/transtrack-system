<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';
import { User } from '@/types';
import { router } from '@inertiajs/vue3';
import { Mail, UserIcon } from 'lucide-vue-next';

defineProps<{ servicedBy: User }>();

const handleVisitUser = (id: number) => {
  router.visit(route('profile.detail', { id }));
};
</script>

<template>
  <Card @click="handleVisitUser(servicedBy.id)">
    <CardHeader>
      <CardTitle> Service By </CardTitle>
      <CardDescription> User who serviced the vehicle </CardDescription>
    </CardHeader>
    <CardContent>
      <div class="flex flex-col">
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
          @click="(e) => e.stopPropagation()"
        >
          <Mail :size="18" />
          <span>
            {{ servicedBy.email }}
          </span>
        </a>
      </div>
    </CardContent>
  </Card>
</template>
