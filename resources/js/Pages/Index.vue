<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';
</script>

<template>
  <Head title="Welcome" />
  <div
    class="flex h-screen flex-col items-center justify-center bg-gray-50 text-black/50 dark:bg-black dark:text-white/50"
  >
    <div class="flex flex-1 items-center">
      <Card class="flex flex-col items-center p-8">
        <CardHeader class="items-center">
          <img
            src="../../../public/icon.png"
            alt="transtrack"
            width="70"
            height="70"
            class="mb-4"
          />
          <CardTitle>
            <Link href="/">Transtrack System</Link>
          </CardTitle>
          <CardDescription>
            All in one system for vehicle management
          </CardDescription>
        </CardHeader>
        <CardContent>
          <div class="flex items-center">
            <Link
              v-if="$page.props.auth.user"
              :href="route('dashboard')"
              class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
              Dashboard
            </Link>

            <template v-else>
              <Link
                :href="route('login')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
              >
                Log in
              </Link>

              <Link
                :href="route('register')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
              >
                Register
              </Link>
            </template>
          </div>
        </CardContent>
      </Card>
    </div>
  </div>
</template>
