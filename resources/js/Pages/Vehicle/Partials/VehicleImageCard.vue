<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';

defineProps<{ photo: string | null }>();
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle>Vehicle Image</CardTitle>
    </CardHeader>
    <CardContent>
      <img
        v-if="photo"
        :src="`/storage/${photo}`"
        alt="Vehicle Image"
        class="rounded-lg object-contain"
      />
      <template v-else>
        <div class="rounded-lg border border-dashed border-gray-300 p-4">
          No photo uploaded
        </div>
      </template>
    </CardContent>
  </Card>
</template>
