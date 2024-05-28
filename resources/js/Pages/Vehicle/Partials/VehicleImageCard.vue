<script setup lang="ts">
defineProps<{ photo: string | null }>();
</script>

<template>
  <div class="min-h-60 items-center justify-center">
    <img
      v-if="photo"
      :src="`/storage/${photo}`"
      alt="Vehicle Image"
      class="h-60 w-96 rounded-lg bg-red-400 object-contain"
    />
    <template v-else>
      <div class="rounded-lg border border-dashed border-gray-300 p-4">
        No photo uploaded
      </div>
    </template>
  </div>
</template>
