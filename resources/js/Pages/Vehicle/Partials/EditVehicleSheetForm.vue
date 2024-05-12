<script setup lang="ts">
import {
  Sheet,
  SheetClose,
  SheetContent,
  SheetDescription,
  SheetFooter,
  SheetHeader,
  SheetTitle,
} from '@/Components/ui/sheet';
import { Button } from '@/Components/ui/button';

defineProps<{
  open: boolean;
  onClose: () => void;
}>();
</script>

<template>
  <Sheet :open="open" :onUpdate:open="onClose">
    <SheetContent>
      <SheetHeader>
        <SheetTitle>Are you</SheetTitle>
        <SheetDescription>hye</SheetDescription>
      </SheetHeader>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea atque
        distinctio quae quas error exercitationem temporibus illum, dolorem
        velit voluptates nisi tempore aspernatur repellat nesciunt fugit nostrum
        adipisci accusamus assumenda!
      </p>
      <SheetFooter>
        <SheetClose as-child>
          <Button>close</Button>
        </SheetClose>
      </SheetFooter>
    </SheetContent>
  </Sheet>
</template>
