<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import {
  Table,
  TableBody,
  TableCell,
  TableHeader,
  TableRow,
  TableHead,
} from '@/Components/ui/table';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { refreshPage } from '@/lib/utils';
import { User } from '@/types';
import { Head, router, usePage } from '@inertiajs/vue3';
import { MoreHorizontal } from 'lucide-vue-next';
import { onMounted, ref } from 'vue';
import { toast } from 'vue-sonner';

const users = usePage().props.users as User[];
const usersRef = ref<User[]>([]);

onMounted(() => {
  usersRef.value = users.filter(
    (user) => user.email !== 'admin@transtrack.com',
  );
});

const changeRole = (user: User, role: string) => {
  router.put(route('admin.update-role', { id: user.id, role }));
  toast.success(
    `User ${user.name} role has been updated to ${role.toUpperCase()}`,
  );
  refreshPage();
};
</script>

<template>
  <Head title="Admin" />

  <AuthenticatedLayout>
    <template #header>
      <div class="space-y-4 py-4">
        <div class="mx-auto max-w-7xl space-y-4 sm:px-4 lg:px-8">
          <div class="rounded-lg dark:bg-gray-800">
            <Card>
              <CardHeader>
                <CardTitle>User Role Management</CardTitle>
                <CardDescription> Manage user roles </CardDescription>
              </CardHeader>
              <CardContent>
                <Table>
                  <TableHeader>
                    <TableHead>Name</TableHead>
                    <TableHead>Email</TableHead>
                    <TableHead>Role</TableHead>
                    <TableHead></TableHead>
                  </TableHeader>
                  <TableBody>
                    <TableRow v-for="user of usersRef" :key="user.id">
                      <TableCell>
                        {{ user.name }}
                      </TableCell>
                      <TableCell>
                        {{ user.email }}
                      </TableCell>
                      <TableCell>
                        <DropdownMenu>
                          <DropdownMenuTrigger as-child>
                            <Button size="sm" variant="outline">
                              {{ user.role.toUpperCase() }}
                            </Button>
                          </DropdownMenuTrigger>
                          <DropdownMenuContent>
                            <DropdownMenuItem
                              @click="changeRole(user, 'personnel')"
                            >
                              Personnel
                            </DropdownMenuItem>
                            <DropdownMenuItem
                              @click="changeRole(user, 'admin')"
                            >
                              Admin
                            </DropdownMenuItem>
                            <DropdownMenuItem
                              @click="changeRole(user, 'manager')"
                            >
                              Fleet Manager
                            </DropdownMenuItem>
                            <DropdownMenuItem
                              @click="changeRole(user, 'driver')"
                            >
                              Driver
                            </DropdownMenuItem>
                          </DropdownMenuContent>
                        </DropdownMenu>
                      </TableCell>
                      <TableCell class="text-right">
                        <Button size="icon" variant="ghost">
                          <MoreHorizontal :size="18" />
                        </Button>
                      </TableCell>
                    </TableRow>
                  </TableBody>
                </Table>
              </CardContent>
            </Card>
          </div>
        </div>
      </div>
    </template>
  </AuthenticatedLayout>
</template>
