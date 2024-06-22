<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from '@/Components/ui/card';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div
    class="flex min-h-screen flex-col items-center bg-gray-100 dark:bg-gray-900 sm:justify-center sm:pt-0"
  >
    <div
      class="w-full space-y-4 overflow-hidden dark:bg-gray-800 sm:max-w-md sm:rounded-lg"
    >
      <Card class="dark:bg-gray-800">
        <CardHeader class="items-center">
          <Link href="/">
            <img
              src="../../../public/icon.png"
              alt="transtrack"
              width="70"
              height="70"
              class="mb-4"
            />
          </Link>
          <CardTitle> Transtrack System </CardTitle>
          <CardDescription>
            All in one system for vehicle management
          </CardDescription>
        </CardHeader>
        <CardContent>
          <slot />
        </CardContent>
      </Card>
    </div>
  </div>
</template>
