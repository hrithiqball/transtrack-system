<script setup lang="ts">
import { ref } from 'vue';
import { GoogleMap, Marker } from 'vue3-google-map';

defineProps<{ lat: number; lng: number }>();

const apiKey = ref(import.meta.env.VITE_GOOGLE_MAP_API);
const zoom = ref(15);
</script>

<template>
  <div
    class="flex min-h-60 flex-1 items-center justify-center rounded-lg bg-slate-200 dark:bg-slate-500"
  >
    <GoogleMap
      :apiKey
      :center="{ lat, lng }"
      :zoom
      class="h-[230px] w-full rounded-lg"
    >
      <Marker :options="{ position: { lat, lng } }" />
    </GoogleMap>
  </div>
</template>
