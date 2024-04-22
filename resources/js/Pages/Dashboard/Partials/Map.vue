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
        <div>
          <h1>Uluru</h1>
          <div>
            <p>
              <b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large
              sandstone rock formation in the southern part of the Northern
              Territory, central Australia. It lies 335&#160;km (208&#160;mi)
              south west of the nearest large town, Alice Springs; 450&#160;km
              (280&#160;mi) by road. Kata Tjuta and Uluru are the two major
              features of the Uluru - Kata Tjuta National Park. Uluru is sacred
              to the Pitjantjatjara and Yankunytjatjara, the Aboriginal people
              of the area. It has many springs, waterholes, rock caves and
              ancient paintings. Uluru is listed as a World Heritage Site.
            </p>
          </div>
        </div>
      </InfoWindow>
    </Marker>
  </GoogleMap>
</template>
