<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import { GoogleMap, InfoWindow, Marker } from 'vue3-google-map';
import VehicleInfoMessage from './VehicleInfoMessage.vue';
import { DarkMode, LightMode, center } from '@/static/google-map';
import { useDark } from '@vueuse/core';
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';

const vehicles = usePage().props.vehicles as unknown as Vehicle[];

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

const markerList = vehicles.map((vehicle) => ({
  id: vehicle.id,
  position: {
    lat: vehicle.latitude,
    lng: vehicle.longitude,
  },
  vehicle: {
    plateNumber: vehicle.plateNumber,
    brand: vehicle.brand,
    model: vehicle.model,
    color: vehicle.color,
    status: vehicle.status,
  },
}));
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle> Vehicle Location </CardTitle>
      <CardDescription> View vehicle locations here. </CardDescription>
    </CardHeader>
    <CardContent>
      <GoogleMap :api-key :styles :center :zoom class="h-[500px] w-full">
        <Marker
          v-for="marker of markerList"
          :key="marker.id"
          :options="{
            position: { lat: marker.position.lat, lng: marker.position.lng },
          }"
        >
          <InfoWindow>
            <VehicleInfoMessage
              :plateNumber="marker.vehicle.plateNumber"
              :brand="marker.vehicle.brand"
              :model="marker.vehicle.model"
              :color="marker.vehicle.color"
              :status="marker.vehicle.status"
            />
          </InfoWindow>
        </Marker>
      </GoogleMap>
    </CardContent>
  </Card>
</template>
