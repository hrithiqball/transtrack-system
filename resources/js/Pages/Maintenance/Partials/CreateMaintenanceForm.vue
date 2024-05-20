<script setup lang="ts">
import { User } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { onMounted, ref } from 'vue';
import { CalendarIcon, LoaderCircle } from 'lucide-vue-next';
import { Label } from '@/Components/ui/label';
import { Input } from '@/Components/ui/input';
import { Calendar } from '@/Components/ui/calendar';
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/Components/ui/popover';
import { cn } from '@/lib/utils';
import {
  DateFormatter,
  type DateValue,
  getLocalTimeZone,
} from '@internationalized/date';
import { toast } from 'vue-sonner';

const df = new DateFormatter('en-MY', {
  dateStyle: 'long',
});

const props = defineProps<{ vehicleId: number }>();
const vehicleId = props.vehicleId;

const personnelList = ref<User[]>([]);
const loading = ref(true);
const maintenanceDateInput = ref<DateValue | null>(null);

onMounted(() => {
  fetchPersonnel();
});

const fetchPersonnel = async () => {
  try {
    const response = await fetch(route('user.list', { role: 'personnel' }));
    if (!response.ok) {
      throw new Error('Failed to fetch personnel list');
    }

    const data = await response.json();
    personnelList.value = data;
    loading.value = false;
  } catch (error) {
    console.error('Error fetching user list', error);
  }
};

const form = useForm({
  vehicle_id: vehicleId,
  maintenance_date: '',
  serviced_by: '',
  remarks: '',
});

const createMaintenance = () => {
  if (!maintenanceDateInput.value) {
    console.log('maintenanceDateInput.value is not defined');
    return;
  }
  toast.info('Maintenance date is not defined');
  form.maintenance_date = maintenanceDateInput.value
    ?.toDate(getLocalTimeZone())
    .toISOString()
    .slice(0, 19)
    .replace('T', ' ');

  form.post(route('maintenance.store'));
};
</script>

<template>
  <section v-if="!loading">
    <form class="mt-4 space-y-4" @submit.prevent="createMaintenance">
      <div>
        <Label> Maintenance Date </Label>
        <Popover>
          <PopoverTrigger as-child>
            <Button
              variant="outline"
              :class="
                cn(
                  'w-full justify-start border-solid text-left font-normal',
                  !maintenanceDateInput && 'text-muted-foreground',
                )
              "
            >
              <CalendarIcon class="mr-2 size-4" />
              <template v-if="maintenanceDateInput">
                {{ df.format(maintenanceDateInput.toDate(getLocalTimeZone())) }}
              </template>
              <template v-else>
                <span> Pick a date </span>
              </template>
            </Button>
          </PopoverTrigger>
          <PopoverContent class="w-auto p-0">
            <Calendar v-model="maintenanceDateInput" />
          </PopoverContent>
        </Popover>
      </div>

      <div>
        <Label>Remarks</Label>
        <Input
          id="remarks"
          v-model="form.remarks"
          type="text"
          autocomplete="maintenance-remarks"
          class="mt-1 block w-full"
        />
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
            Saved
          </p>
        </Transition>
      </div>
    </form>
  </section>
  <template v-else>
    <div class="flex items-center justify-center">
      <LoaderCircle class="my-8 animate-spin" />
    </div>
  </template>
</template>
