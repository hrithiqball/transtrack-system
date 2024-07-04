<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { User } from '@/types';
import { usePage } from '@inertiajs/vue3';
import {
  BriefcaseBusiness,
  CircleGauge,
  CircleHelp,
  Mail,
  Shield,
  UserIcon,
} from 'lucide-vue-next';

const user = usePage().props.user as User;
</script>

<template>
  <AuthenticatedLayout>
    <div class="py-12">
      <div class="mx-auto max-w-7xl space-y-4 sm:px-6 lg:px-8">
        <div
          class="overflow-hidden bg-white p-4 shadow-sm dark:bg-gray-800 sm:rounded-lg"
        >
          <div class="flex flex-col items-center space-y-4">
            <div
              class="flex size-32 items-center justify-center rounded-full bg-slate-100 text-4xl dark:bg-slate-900"
            >
              {{ user.name.charAt(0).toUpperCase() }}
            </div>
            <span>
              {{ user.name }}
            </span>
            <div class="flex items-center space-x-2">
              <Mail :size="18" />
              <span>
                {{ user.email }}
              </span>
            </div>
            <div class="flex items-center space-x-2">
              <BriefcaseBusiness v-if="user.role === 'manager'" :size="18" />
              <CircleGauge v-else-if="user.role === 'driver'" :size="18" />
              <UserIcon v-else-if="user.role === 'personnel'" :size="18" />
              <CircleHelp v-else :size="18" />
              <span>
                {{ user.role.toUpperCase() }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
