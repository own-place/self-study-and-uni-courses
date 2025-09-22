import { writable } from "svelte/store";

// Create a writable store for pantry data
// Initial value is an empty array since we don't have data yet
export const pantryStore = writable([]);
export const categoriesStore = writable([]);
