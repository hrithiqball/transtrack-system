<script setup lang="ts">
import { Maintenance } from '@/types/Maintenance';

defineProps<{ maintenances: Maintenance[] | undefined }>();
</script>

<template>
  <div>
    <span>
      Count is
      {{ maintenances?.length }}
    </span>
  </div>
</template>
