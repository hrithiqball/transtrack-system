<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Maintenance } from '@/types/Maintenance';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTrigger,
} from '@/Components/ui/dialog';
import { Button } from '@/Components/ui/button';

const maintenances = usePage().props.maintenances as Maintenance;
</script>

<template>
  <Head title="Maintenance" />

  <AuthenticatedLayout> hello </AuthenticatedLayout>
</template>
