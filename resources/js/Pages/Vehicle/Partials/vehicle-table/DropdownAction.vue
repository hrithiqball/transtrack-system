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
import { Sheet, SheetContent, SheetTrigger } from '@/Components/ui/sheet';

defineProps<{
  plateNumber: string;
}>();

const copy = (id: string) => {
  navigator.clipboard.writeText(id);
};
</script>

<template>
  <Sheet>
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
          Copy payment ID
        </DropdownMenuItem>
        <DropdownMenuSeparator />
        <SheetTrigger as-child>
          <DropdownMenuItem>View Customer</DropdownMenuItem>
        </SheetTrigger>
        <DropdownMenuItem>View Payment details</DropdownMenuItem>
      </DropdownMenuContent>
    </DropdownMenu>
    <SheetContent>
      <p>hello</p>
    </SheetContent>
  </Sheet>
</template>
