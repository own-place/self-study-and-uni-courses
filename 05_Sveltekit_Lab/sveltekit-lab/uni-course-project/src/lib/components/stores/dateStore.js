import { writable } from 'svelte/store';

export const dateStore = writable({
    day: 27,
    month: 9,
    year: 2024,
    doy: 270,
});