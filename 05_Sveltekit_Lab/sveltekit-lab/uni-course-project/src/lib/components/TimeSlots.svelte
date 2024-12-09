<script>
	import { getContext, onMount } from 'svelte';
	import TimeSlot from './TimeSlot.svelte';
    import { dateStore } from './stores/dateStore';

	let timeslotAppointmentMatchedArr = [];
    let currentDay;

	const timeslotsApiUrl = `${getContext('apiReference').mainUrl}timeslots/`;

	const fetchData = async (url) => {
		try {
			const response = await fetch(url);
			const items = await response.json();
			return items;
		} catch (error) {
			return { error };
		}
	};

    const waitAllFetches = async (urls) => {
        try {
            const response = await Promise.all(urls);
            return response;
        } catch (error) {
            return {error};
        }
    };

    // checks if there is a matching appointment for a given timeslot ID
    const ifTheIdMatched = (timeslotId, appointmentData) => {
        // search for an appointment object (in appointmentData) that has a timeslotId matching the timeslotId parameter
        const matched = appointmentData.find((appointment) => appointment.timeslotId === timeslotId);
        return matched;
    };

    onMount(async () => {
		// update the selected current date
		dateStore.subscribe((value) => {
			currentDay = value.doy;
            // console.log(currentDay);
            getAllData(currentDay);
		});
	});

    const getAllData = async (currentDay) => {
        // fetch timeslots urls and appoinments urls
        const timeslotsUrlArr = await fetchData(timeslotsApiUrl);
        const appoinmentsUrlArrOnOneDay = await fetchData(`http://localhost:3015/api/v1/appointments?day=${currentDay}`);
        // extract all the urls from the result (urls array)
        const timeslotsUrlArrData = timeslotsUrlArr.data;
        const appoinmentsUrlArrOnOneDayData = appoinmentsUrlArrOnOneDay.data;
        // use each url to fetch again
        const fetchEachTimeslot = timeslotsUrlArrData.map((url)=>fetchData(`http://localhost:3015/api/v1${url}`));
        const fetchEachAppointmentOnOneDay = appoinmentsUrlArrOnOneDayData.map((url)=>fetchData(`http://localhost:3015/api/v1${url}`));
        // wait for all promises to resolve
        const timeslotsData = await waitAllFetches(fetchEachTimeslot);
        const appointmentsData = await waitAllFetches(fetchEachAppointmentOnOneDay);
        
        // fill the timeslotAppointmentMatchedArr with the matched appointment
        // for each timeslot, it calls the ifTheIdMatched function, passing the timeslot.id and the appointmentsData array as arguments
        timeslotAppointmentMatchedArr = timeslotsData.map((timeslot) => {
            // if there is a matching appointment for the current timeslot
            // return the timeslot with the matching appointment
            if (ifTheIdMatched(timeslot.id, appointmentsData)) {
                return {
                    ...timeslot, // a new object is created using the spread operator ... to copy all properties of the timeslot object
                    appointment: ifTheIdMatched(timeslot.id, appointmentsData) // the appointment property of the new object is set to the matched appointment object
                };
            } else {
                // otherwise, return the timeslot without an appointment
                return {
                    ...timeslot,
                    appointment: undefined
                };
            }
        });
        // console.log(timeslotAppointmentMatchedArr);
    };
</script>

<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
	{#each timeslotAppointmentMatchedArr as item}
		<TimeSlot contents={item} />
	{/each}
</div>
