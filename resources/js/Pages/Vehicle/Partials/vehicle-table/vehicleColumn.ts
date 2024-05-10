import { ColumnDef } from '@tanstack/vue-table';
import DropdownAction from '../vehicle-table/DropdownAction.vue';
import { ArrowUpDown, ChevronDown } from 'lucide-vue-next';
import { h } from 'vue';
import Button from '@/Components/ui/button/Button.vue';
import { Checkbox } from '@/Components/ui/checkbox';
import { Vehicle } from '@/types/Vehicle';

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
    accessorKey: 'plate_number',
    header: () => h('div', 'Plate Number'),
    cell: ({ row }) => {
      return h('div', row.original.plate_number);
    },
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
    id: 'actions',
    enableHiding: false,
    cell: ({ row }) => {
      return h(
        'div',
        { class: 'relative', style: { 'text-align': 'right' } },
        h(DropdownAction, {
          plateNumber: row.original.plate_number,
        }),
      );
    },
  },
];
