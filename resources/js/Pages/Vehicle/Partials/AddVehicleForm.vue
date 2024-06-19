<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { InertiaForm, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue-sonner';

const brandInput = ref<HTMLInputElement | null>(null);
const modelInput = ref<HTMLInputElement | null>(null);
const plateNumberInput = ref<HTMLInputElement | null>(null);
const colorInput = ref<HTMLInputElement | null>(null);
const yearInput = ref<HTMLInputElement | null>(null);
const latitudeInput = ref<HTMLInputElement | null>(null);
const longitudeInput = ref<HTMLInputElement | null>(null);
const previewUrl = ref<string | null>(null);
const imageFile = ref<File | null>(null);

const previewImage = (event: Event) => {
  if (!event.target) {
    return;
  }

  const fileInput = event.target as HTMLInputElement;
  const file = fileInput.files?.[0];

  if (!file) {
    return;
  }

  imageFile.value = file;
  const reader = new FileReader();

  reader.onload = (e) => {
    previewUrl.value = e.target?.result as string;
    fileInput.value = '';
  };

  reader.readAsDataURL(file);
};

const form: InertiaForm<{
  brand: string;
  model: string;
  plate_number: string;
  color: string;
  year: string;
  latitude: string;
  longitude: string;
  photo: File | null;
}> = useForm({
  brand: '',
  model: '',
  plate_number: '',
  color: '#ffffff',
  year: '',
  latitude: '',
  longitude: '',
  photo: null,
});

const createVehicle = () => {
  form.photo = imageFile.value;
  form.post(route('vehicle.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
    onError: (e) => {
      console.error(e);
      if (form.errors.photo) {
        toast.error(form.errors.photo);
      }
      if (form.errors.brand) {
        form.reset('brand');
        brandInput.value?.focus();
      }

      if (form.errors.model) {
        form.reset('model');
        modelInput.value?.focus();
      }

      if (form.errors.plate_number) {
        form.reset('plate_number');
        plateNumberInput.value?.focus();
      }

      if (form.errors.color) {
        form.reset('color');
        colorInput.value?.focus();
      }

      if (form.errors.year) {
        form.reset('year');
        yearInput.value?.focus();
      }

      if (form.errors.latitude) {
        form.reset('latitude');
        latitudeInput.value?.focus();
      }

      if (form.errors.longitude) {
        form.reset('longitude');
        longitudeInput.value?.focus();
      }
    },
  });
};
</script>

<template>
  <section>
    <form class="mt-4 space-y-4" @submit.prevent="createVehicle">
      <div>
        <InputLabel for="brand" value="Brand" />

        <TextInput
          id="brand"
          v-model="form.brand"
          type="text"
          required
          autofocus
          autocomplete="car-brand"
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.brand" class="mt-2" />
      </div>

      <div>
        <InputLabel for="model" value="Model" />

        <TextInput
          id="model"
          v-model="form.model"
          type="text"
          required
          autofocus
          autocomplete="car-model"
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.model" class="mt-2" />
      </div>

      <div>
        <InputLabel for="plate_number" value="Plate Number" />

        <TextInput
          id="plate_number"
          v-model="form.plate_number"
          type="text"
          required
          autofocus
          autocomplete="plate-number"
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.plate_number" class="mt-2" />
      </div>

      <div>
        <InputLabel for="color" value="Color" />

        <TextInput
          id="color"
          v-model="form.color"
          type="color"
          required
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.color" class="mt-2" />
      </div>

      <div>
        <InputLabel for="year" value="Year of Make" />

        <TextInput
          id="year"
          v-model="form.year"
          type="number"
          required
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.year" class="mt-2" />
      </div>

      <div>
        <InputLabel for="photo" value="Photo" />

        <Input
          type="file"
          placeholder="Vehicle Image"
          accept=".png, .jpg"
          @change="previewImage"
        />
        <template v-if="previewUrl">
          <img
            :src="previewUrl"
            alt="Preview Image"
            class="mt-2 h-auto w-40 object-cover"
          />
        </template>
      </div>

      <div>
        <InputLabel for="latitude" value="Latitude" />

        <TextInput
          id="latitude"
          v-model="form.latitude"
          type="number"
          step="0.0000001"
          required
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.latitude" class="mt-2" />
      </div>

      <div>
        <InputLabel for="longitude" value="Longitude" />

        <TextInput
          id="longitude"
          v-model="form.longitude"
          type="number"
          step="0.0000001"
          required
          class="mt-1 block w-full"
        />

        <InputError :message="form.errors.longitude" class="mt-2" />
      </div>

      <div class="flex items-center gap-4">
        <Button variant="outline" :disabled="form.processing">Save</Button>

        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
        >
          <p
            v-if="form.recentlySuccessful"
            class="text-sm text-gray-600 dark:text-gray-400"
          >
            Saved.
          </p>
        </Transition>
      </div>
    </form>
  </section>
</template>
