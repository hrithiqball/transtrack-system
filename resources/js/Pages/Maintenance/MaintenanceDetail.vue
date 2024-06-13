<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Maintenance } from '@/types/Maintenance';
import { usePage } from '@inertiajs/vue3';

const maintenance = usePage().props.maintenance as Maintenance;
</script>

<template>
  <AuthenticatedLayout>
    <button @click="console.log(maintenance)">{{ maintenance.id }}</button>
  </AuthenticatedLayout>
</template>
