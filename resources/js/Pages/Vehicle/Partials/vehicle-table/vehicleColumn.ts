import { ColumnDef } from '@tanstack/vue-table';
import DropdownAction from '../vehicle-table/DropdownAction.vue';
import { ArrowUpDown, ChevronDown } from 'lucide-vue-next';
import { h } from 'vue';
import Button from '@/Components/ui/button/Button.vue';
import { Checkbox } from '@/Components/ui/checkbox';

export interface Payment {
  id: string;
  amount: number;
  // status: 'pending' | 'processing' | 'success' | 'failed';
  status: string;
  email: string;
}

export const data: Payment[] = [
  {
    id: '728ed52f',
    amount: 100,
    status: 'pending',
    email: 'm@example.com',
  },
  {
    id: '489e1d42',
    amount: 125,
    status: 'processing',
    email: 'example@gmail.com',
  },
];

export const columns: ColumnDef<Payment>[] = [
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
    accessorKey: 'amount',
    header: () => h('div', 'Amount'),
    cell: ({ row }) => {
      const amount = row.original.amount;
      const formatted = new Intl.NumberFormat('en-MY', {
        style: 'currency',
        currency: 'MYR',
      }).format(amount);

      return h('div', formatted);
    },
  },
  {
    accessorKey: 'email',
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: 'ghost',
          onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
        },
        () => ['Email', h(ArrowUpDown, { class: 'ml-2 size-4' })],
      );
    },
    cell: ({ row }) => h('div', { class: 'lowercase' }, row.original.email),
  },
  {
    id: 'actions',
    enableHiding: false,
    cell: ({ row }) => {
      return h(
        'div',
        { class: 'relative', style: { 'text-align': 'right' } },
        h(DropdownAction, {
          payment: row.original,
        }),
      );
    },
  },
];
