<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Booking } from '@/types/Booking';
import { User } from '@/types';
import {
  DropdownMenu,
  DropdownMenuTrigger,
  DropdownMenuContent,
  DropdownMenuItem,
} from '@/Components/ui/dropdown-menu';
import { Table, TableBody, TableRow, TableCell } from '@/Components/ui/table';
import { router } from '@inertiajs/vue3';

const bookings = usePage().props.bookings as Booking[];
const users = usePage().props.users as User[];

const changeRole = (id: number, role: string) => {
  router.put(route('admin.update-role', { id, role }));
};
</script>

<template>
  <Head title="Admin" />

  <AuthenticatedLayout>
    <div>
      <div class="space-y-4 py-4">
        <div class="mx-auto max-w-7xl space-y-4 sm:px-4 lg:px-8">
          <div class="rounded-lg bg-white p-4 shadow dark:bg-gray-800">
            <div>
              <h3 class="text-lg font-semibold">User Management</h3>
              <Table>
                <TableBody>
                  <TableRow v-for="user of users" :key="user.id">
                    <TableCell>
                      {{ user.name }}
                    </TableCell>
                    <TableCell>
                      {{ user.email }}
                    </TableCell>
                    <TableCell class="text-right">
                      <DropdownMenu>
                        <DropdownMenuTrigger as-child>
                          <Button size="sm" variant="outline">
                            {{ user.role.toUpperCase() }}
                          </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent>
                          <DropdownMenuItem
                            @click="changeRole(user.id, 'personnel')"
                          >
                            Personnel
                          </DropdownMenuItem>
                          <DropdownMenuItem
                            @click="changeRole(user.id, 'admin')"
                          >
                            Admin
                          </DropdownMenuItem>
                          <DropdownMenuItem
                            @click="changeRole(user.id, 'manager')"
                          >
                            Fleet Manager
                          </DropdownMenuItem>
                          <DropdownMenuItem
                            @click="changeRole(user.id, 'driver')"
                          >
                            Driver
                          </DropdownMenuItem>
                        </DropdownMenuContent>
                      </DropdownMenu>
                    </TableCell>
                  </TableRow>
                </TableBody>
              </Table>
            </div>
            <div>
              <h3 class="text-lg font-semibold">Booking Request</h3>
              <div v-if="bookings.length > 0" class="flex flex-col">
                <div v-for="booking of bookings" :key="booking.id">
                  {{ booking.notes }}
                </div>
              </div>
              <template v-else>
                <div class="text-center text-gray-500 dark:text-gray-400">
                  No bookings found
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
