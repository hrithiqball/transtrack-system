<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
  class?: HTMLAttributes['class'];
}>();
</script>

<template>
  <div
    :class="
      cn(
        'rounded-xl border bg-white text-card-foreground shadow dark:bg-gray-900',
        props.class,
      )
    "
  >
    <slot />
  </div>
</template>
