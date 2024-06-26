<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';
import { Booking } from '@/types/Booking';
import { Maintenance } from '@/types/Maintenance';
import { Vehicle } from '@/types/Vehicle';
import { usePage } from '@inertiajs/vue3';
import {
  createCalendar,
  viewMonthAgenda,
  viewMonthGrid,
  viewWeek,
} from '@schedule-x/calendar';
import '@schedule-x/theme-default/dist/index.css';
import { ScheduleXCalendar } from '@schedule-x/vue';
import { format, startOfToday } from 'date-fns';

const vehicles = usePage().props.vehicles as Vehicle[];

const events = mapEvent();
const calendarApp = createCalendar({
  selectedDate: convertToDate(startOfToday().toString()),
  views: [viewWeek, viewMonthGrid, viewMonthAgenda],
  defaultView: viewMonthGrid.name,
  events,
});

function convertToDate(date: string) {
  const dateTime = new Date(date);

  return `${format(dateTime, 'yyyy')}-${format(dateTime, 'MM')}-${format(dateTime, 'dd')}`;
}

function mapEvent() {
  const maintenances: Maintenance[] = [];
  const bookings: Booking[] = [];

  vehicles.forEach((vehicle) => {
    vehicle.maintenances?.forEach((maintenance) => {
      maintenances.push(maintenance);
    });

    vehicle.bookings?.forEach((booking) => {
      booking.vehicle = vehicle;
      bookings.push(booking);
    });
  });

  maintenances.forEach((maintenance) => {
    maintenance.maintenanceDate = convertToDate(maintenance.maintenanceDate);
  });

  bookings.forEach((booking) => {
    booking.startDate = convertToDate(booking.startDate);
    booking.endDate = convertToDate(booking.endDate);
  });

  const maintenancesEvent = maintenances.map((maintenance) => ({
    id: `MTN-${maintenance.id}`,
    title: `(M) ${maintenance.remarks}, ${maintenance.vehicle.plateNumber} (${maintenance.vehicle.brand} ${maintenance.vehicle.model})`,
    start: maintenance.maintenanceDate,
    end: maintenance.maintenanceDate,
  }));

  const bookingsEvent = bookings.map((booking) => ({
    id: `BKG-${booking.id}`,
    title: `(B) ${booking.notes}, ${booking.vehicle.plateNumber} (${booking.vehicle.brand} ${booking.vehicle.model})`,
    start: booking.startDate,
    end: booking.endDate,
  }));

  return [...maintenancesEvent, ...bookingsEvent];
}
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle> Calendar </CardTitle>
      <CardDescription>
        View all bookings and maintenance schedules here.
      </CardDescription>
    </CardHeader>
    <CardContent>
      <ScheduleXCalendar :calendar-app="calendarApp" />
    </CardContent>
  </Card>
</template>
