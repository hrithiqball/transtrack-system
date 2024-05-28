<script setup lang="ts">
import { ref } from 'vue';
import { GoogleMap, Marker, InfoWindow } from 'vue3-google-map';

const apiKey = ref(import.meta.env.VITE_GOOGLE_MAP_API);
const center = ref({ lat: 3.06834, lng: 101.506318 });
const zoom = ref(15);
defineProps<{ lat: number; lng: number }>();
</script>

<template>
  <div
    class="flex min-h-60 flex-1 items-center justify-center rounded-lg bg-blue-500"
  >
    <GoogleMap :apiKey :center :zoom class="h-[240px] w-full rounded-lg">
      <Marker :options="{ position: { lat, lng } }">
        <InfoWindow>
          <div class="">hello</div>
        </InfoWindow>
      </Marker>
    </GoogleMap>
  </div>
</template>
