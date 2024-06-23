<script setup lang="ts">
import { CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import Card from '@/Components/ui/card/Card.vue';
import { DarkMode, LightMode } from '@/static/google-map';
import { useDark } from '@vueuse/core';
import { onMounted, ref, watch } from 'vue';
import { GoogleMap, Marker } from 'vue3-google-map';

defineProps<{ lat: number; lng: number }>();

const apiKey = ref(import.meta.env.VITE_GOOGLE_MAP_API);
const styles = ref(DarkMode);
const zoom = ref(15);

const isDark = useDark();

onMounted(() => {
  styles.value = isDark.value ? DarkMode : LightMode;
});

watch(isDark, (newVal) => {
  if (newVal) {
    styles.value = DarkMode;
    return;
  }

  styles.value = LightMode;
});
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle> Location </CardTitle>
    </CardHeader>
    <CardContent>
      <div class="flex min-h-60 flex-1 items-center justify-center rounded-lg">
        <GoogleMap
          :api-key
          :styles
          :zoom
          :center="{ lat, lng }"
          class="h-[230px] w-full rounded-lg"
        >
          <Marker :options="{ position: { lat, lng } }" />
        </GoogleMap>
      </div>
    </CardContent>
  </Card>
</template>
