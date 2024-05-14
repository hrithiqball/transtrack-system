<script setup lang="ts">
import { ScheduleXCalendar } from '@schedule-x/vue';
import {
  createCalendar,
  viewWeek,
  viewMonthGrid,
  viewMonthAgenda,
} from '@schedule-x/calendar';
import '@schedule-x/theme-default/dist/index.css';

const calendarApp = createCalendar({
  selectedDate: '2024-05-15',
  views: [viewWeek, viewMonthGrid, viewMonthAgenda],
  defaultView: viewMonthGrid.name,
  events: [
    {
      id: 1,
      title: 'Event 1',
      start: '2024-05-01',
      end: '2024-05-19',
    },
    {
      id: 2,
      title: 'Event 2',
      start: '2024-05-28 12:00',
      end: '2024-05-20 13:00',
    },
  ],
});
</script>

<template>
  <div>
    <ScheduleXCalendar :calendar-app="calendarApp" />
  </div>
</template>
