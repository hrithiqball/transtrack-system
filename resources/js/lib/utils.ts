import { Updater } from '@tanstack/vue-table';
import { type ClassValue, clsx } from 'clsx';
import { twMerge } from 'tailwind-merge';
import { Ref } from 'vue';

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs));
}

export function valueUpdater<T extends Updater<any>>(
  updateOrValue: T,
  ref: Ref,
) {
  ref.value =
    typeof updateOrValue === 'function'
      ? updateOrValue(ref.value)
      : updateOrValue;
}

export function refreshPage() {
  window.location.reload();
}
