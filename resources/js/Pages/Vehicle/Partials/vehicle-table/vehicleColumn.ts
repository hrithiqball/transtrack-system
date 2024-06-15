import { Button } from '@/Components/ui/button';
import { Checkbox } from '@/Components/ui/checkbox';
import { Vehicle } from '@/types/Vehicle';
import { ColumnDef } from '@tanstack/vue-table';
import { ArrowUpDown } from 'lucide-vue-next';
import { h } from 'vue';
import DropdownAction from '../vehicle-table/DropdownAction.vue';
import PlateNumberCell from './PlateNumberCell.vue';
import StatusCell from './StatusCell.vue';

export const columns: ColumnDef<Vehicle>[] = [
  {
    id: 'select',
    header: ({ table }) =>
      h(Checkbox, {
        checked: table.getIsAllPageRowsSelected(),
        'onUpdate:checked': (value: boolean) =>
          table.toggleAllPageRowsSelected(Boolean(value)),
        ariaLabel: 'Select all rows on this page',
      }),
    cell: ({ row }) =>
      h(Checkbox, {
        checked: row.getIsSelected(),
        'onUpdate:checked': (value: boolean) =>
          row.toggleSelected(Boolean(value)),
        ariaLabel: `Select row with id ${row.original.id}`,
      }),
    enableSorting: false,
    enableHiding: false,
  },
  {
    accessorKey: 'plateNumber',
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: 'ghost',
          onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
        },
        () => ['Plate Number', h(ArrowUpDown, { class: 'ml-2 size-4' })],
      );
    },
    cell: ({ row }) => {
      return h('div', h(PlateNumberCell, { vehicle: row.original }));
    },
    enableHiding: false,
  },
  {
    accessorKey: 'brand',
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: 'ghost',
          onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
        },
        () => ['Brand', h(ArrowUpDown, { class: 'ml-2 size-4' })],
      );
    },
    cell: ({ row }) => h('div', { class: 'lowercase' }, row.original.brand),
  },
  {
    accessorKey: 'model',
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: 'ghost',
          onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
        },
        () => ['Model', h(ArrowUpDown, { class: 'ml-2 size-4' })],
      );
    },
    cell: ({ row }) => h('div', row.original.model),
  },
  {
    accessorKey: 'status',
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: 'ghost',
          onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
        },
        () => ['Status', h(ArrowUpDown, { class: 'ml-2 size-4' })],
      );
    },
    cell: ({ row }) => h(StatusCell, { vehicle: row.original }),
  },
  {
    id: 'actions',
    enableHiding: false,
    cell: ({ row }) => {
      return h(
        'div',
        { class: 'relative', style: { 'text-align': 'right' } },
        h(DropdownAction, {
          vehicle: row.original,
        }),
      );
    },
  },
];
