<script setup lang="ts">
import { MoreHorizontal } from 'lucide-vue-next';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import { Button } from '@/Components/ui/button';
import { router } from '@inertiajs/vue3';

defineProps<{
  plateNumber: string;
}>();

const copy = (id: string) => {
  navigator.clipboard.writeText(id);
};

const openDetails = () => {
  router.visit(`/`);
};
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" class="size-8 p-0">
        <span class="sr-only">Open menu</span>
        <MoreHorizontal class="size-4" />
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuLabel>Actions</DropdownMenuLabel>
      <DropdownMenuItem @click="copy(plateNumber)">
        Copy plate number
      </DropdownMenuItem>
      <DropdownMenuSeparator />
      <DropdownMenuItem>Details</DropdownMenuItem>
      <DropdownMenuItem>Edit</DropdownMenuItem>
      <DropdownMenuItem class="text-red-500">Delete</DropdownMenuItem>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
