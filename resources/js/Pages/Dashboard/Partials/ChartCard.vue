<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';
import { BarChart } from '@/Components/ui/chart-bar';
import { DonutChart } from '@/Components/ui/chart-donut';
import { Maintenance } from '@/types/Maintenance';
import { usePage } from '@inertiajs/vue3';

const maintenances = usePage().props.maintenances as Maintenance[];

const months = getPreviousFiveMonths();
const barChartData = getMaintenanceData();
const personnels = getPersonnels();
const pieChartData = getPersonnelPerformanceData();

function getPreviousFiveMonths() {
  const monthsShortForm = [
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'May',
    'Jun',
    'Jul',
    'Aug',
    'Sep',
    'Oct',
    'Nov',
    'Dec',
  ];
  const result = [];

  const currentDate = new Date();
  let currentMonth = currentDate.getMonth();

  for (let i = 0; i < 6; i++) {
    result.push(monthsShortForm[currentMonth]);
    currentMonth--;
    if (currentMonth < 0) {
      currentMonth = 11;
    }
  }

  return result.reverse();
}

function getPersonnels() {
  const personnels: string[] = [];

  maintenances.forEach((maintenance) => {
    const personnelName = maintenance.servicedBy.name;
    if (!personnels.includes(personnelName)) {
      personnels.push(personnelName);
    }
  });

  return personnels;
}

function getMaintenanceData() {
  const maintenanceCounts: { [key: string]: number } = {};

  months.forEach((month) => {
    maintenanceCounts[month] = 0;
  });

  maintenances.forEach((maintenance) => {
    const date = new Date(maintenance.maintenanceDate);
    const month = date.toLocaleString('default', { month: 'short' });
    if (maintenanceCounts[month] !== undefined) {
      maintenanceCounts[month]++;
    }
  });

  const result = Object.keys(maintenanceCounts).map((month) => ({
    name: month,
    Total: maintenanceCounts[month],
  }));

  return result;
}

function getPersonnelPerformanceData() {
  const personnelPerformance: { [key: string]: number } = {};

  personnels.forEach((personnel) => {
    personnelPerformance[personnel] = 0;
  });

  maintenances.forEach((maintenance) => {
    const personnelName = maintenance.servicedBy.name;
    personnelPerformance[personnelName]++;
  });

  const result = Object.keys(personnelPerformance).map((personnel) => ({
    name: personnel,
    total: personnelPerformance[personnel],
  }));

  return result;
}
</script>

<template>
  <div class="grid grid-cols-5 gap-4">
    <Card class="col-span-3">
      <CardHeader>
        <CardTitle> Maintenance Record </CardTitle>
        <CardDescription>
          Maintenance record for the past 6 months
        </CardDescription>
      </CardHeader>
      <CardContent>
        <BarChart
          index="name"
          :data="barChartData"
          :categories="['Total']"
          :colors="['#6750a4']"
          :y-formatter="
            (tick) => {
              return `${tick}`;
            }
          "
        />
      </CardContent>
    </Card>
    <Card class="col-span-2 flex flex-col">
      <CardHeader>
        <CardTitle> Personnel Performance </CardTitle>
        <CardDescription>
          Performance of personnel handling maintenance to vehicle
        </CardDescription>
      </CardHeader>
      <CardContent class="flex flex-1 flex-col items-center justify-center">
        <DonutChart
          index="name"
          :category="'total'"
          :data="pieChartData"
          :type="'pie'"
          :colors="[
            '#1E90FF',
            '#00BFFF',
            '#4682B4',
            '#87CEEB',
            '#B0C4DE',
            '#778899',
            '#708090',
            '#2F4F4F',
            '#6A5ACD',
            '#7B68EE',
            '#8A2BE2',
            '#9370DB',
            '#BA55D3',
            '#9400D3',
            '#9932CC',
          ]"
        />
      </CardContent>
    </Card>
  </div>
</template>
