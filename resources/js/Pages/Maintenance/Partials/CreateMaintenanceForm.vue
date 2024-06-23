<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import { Calendar } from '@/Components/ui/calendar';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/Components/ui/popover';
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select';
import { cn } from '@/lib/utils';
import { User } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import {
  DateFormatter,
  getLocalTimeZone,
  type DateValue,
} from '@internationalized/date';
import { CalendarIcon, LoaderCircle } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import { toast } from 'vue-sonner';

const df = new DateFormatter('en-MY', {
  dateStyle: 'long',
});

const props = defineProps<{ vehicleId: number }>();
const vehicleId = ref(props.vehicleId);

const personnelList = ref<User[]>([]);
const loading = ref(true);
const maintenanceDateInput = ref<DateValue | null>(null);
const selectedPersonnelId = ref<string | undefined>(undefined);

onMounted(() => {
  fetchPersonnel();
});

const form = useForm({
  vehicle_id: '',
  maintenance_date: '',
  serviced_by: '',
  remarks: '',
});

async function fetchPersonnel() {
  try {
    const response = await fetch(route('user.list', { role: 'personnel' }));
    if (!response.ok) {
      throw new Error('Failed to fetch personnel list');
    }

    const data = await response.json();
    personnelList.value = data;

    if (usePage().props.auth.user.role === 'personnel') {
      selectedPersonnelId.value = usePage().props.auth.user.id.toString();
    }

    loading.value = false;
  } catch (error) {
    console.error('Error fetching user list', error);
  }
}

function createMaintenance() {
  form.vehicle_id = vehicleId.value.toString();

  if (!maintenanceDateInput.value) {
    toast.error('Maintenance date is required');
    return;
  }

  if (!selectedPersonnelId.value) {
    toast.error('Personnel is required');
    return;
  }

  form.serviced_by = selectedPersonnelId.value;
  form.maintenance_date = maintenanceDateInput.value
    ?.toDate(getLocalTimeZone())
    .toISOString()
    .slice(0, 19)
    .replace('T', ' ');

  form.post(route('maintenance.store'));

  toast.success('Maintenance created successfully');
}
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
        <Label>Personnel</Label>
        <Select
          v-model="selectedPersonnelId"
          :disabled="$page.props.auth.user.role === 'personnel'"
        >
          <SelectTrigger>
            <SelectValue placeholder="Select maintenance personnel" />
          </SelectTrigger>
          <SelectContent>
            <SelectGroup v-if="personnelList.length > 0">
              <SelectItem
                v-for="personnel in personnelList"
                :key="personnel.id"
                :value="personnel.id.toString()"
              >
                {{ personnel.name }}
              </SelectItem>
            </SelectGroup>
            <template v-else>
              <div class="m-4">No personnel found</div>
            </template>
          </SelectContent>
        </Select>
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
