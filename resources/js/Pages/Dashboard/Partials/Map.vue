<script setup>
import { GoogleMap, Marker, InfoWindow } from 'vue3-google-map';

const center = { lat: 3.06834, lng: 101.506318 };
const markerList = [{ position: { lat: 3.067247, lng: 101.504279 } }];
</script>

<template>
  <GoogleMap
    api-key="AIzaSyAlOC3BikppdLBZA1yP2akQEmAhQok9F9Y"
    style="width: 100%; height: 500px"
    :center="center"
    :zoom="15"
  >
    <Marker
      v-for="marker of markerList"
      :key="marker"
      :options="{
        position: { lat: marker.position.lat, lng: marker.position.lng },
      }"
    >
      <InfoWindow>
        <div class="prose rounded p-2 dark:bg-gray-900">
          <h1 class="dark:text-gray-400">BMW</h1>
          <div>
            <p class="dark:text-gray-200">Plate Number: ABC123 Model: X5</p>
          </div>
        </div>
      </InfoWindow>
    </Marker>
  </GoogleMap>
</template>
