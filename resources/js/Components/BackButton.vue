<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import { ChevronLeft } from 'lucide-vue-next';

function goBack() {
  window.history.back();
}
</script>

<template>
  <Button class="flex items-center" @click="goBack()">
    <ChevronLeft :size="18" />
    <span> Back </span>
  </Button>
</template>
