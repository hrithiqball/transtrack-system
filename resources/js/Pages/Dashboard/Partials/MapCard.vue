<script setup lang="ts">
import { Vehicle } from '@/types/Vehicle';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { GoogleMap, InfoWindow, Marker } from 'vue3-google-map';
import VehicleInfoMessage from './VehicleInfoMessage.vue';

const center = { lat: 3.06834, lng: 101.506318 };
const apiKey = ref(import.meta.env.VITE_GOOGLE_MAP_API);
const vehicles = usePage().props.vehicles as unknown as Vehicle[];
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
  <GoogleMap :api-key :center="center" :zoom="15" class="h-[500px] w-full">
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
</template>
