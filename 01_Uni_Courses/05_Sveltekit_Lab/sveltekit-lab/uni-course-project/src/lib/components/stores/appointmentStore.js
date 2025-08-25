import { writable } from 'svelte/store';

export const appointmentStore = writable({
    name: 'the pet name',
    breed: 'the pet breed',
    starttime: 'the timeslot of the appointment',
    state: 'state of the appointment',
    date: 'date of the appointment'
});

//write custom functions to update the store