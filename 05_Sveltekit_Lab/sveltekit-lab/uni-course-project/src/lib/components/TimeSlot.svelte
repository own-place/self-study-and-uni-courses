<script>
	import { appointmentStore } from '/Users/luyue/Documents/self-study/sveltekit-lab/uni-course-project/src/lib/components/stores/appointmentStore.js';
	export let contents;

	const displayAppointmentDetail = (selectedAppointment) => {
		// console.log(selectedAppointment);
		$appointmentStore.name = selectedAppointment.appointment.name;
		$appointmentStore.breed = selectedAppointment.appointment.breed;
		$appointmentStore.starttime = selectedAppointment.starttime;
		$appointmentStore.state = selectedAppointment.appointment.state;
		$appointmentStore.date = selectedAppointment.appointment.theDateId;
		console.log($appointmentStore);
	}
</script>

<div>
	{#if contents.appointment}
		<li class="bg-orange-200 p-3">{contents.starttime}</li>
		<li class="bg-orange-100 p-3">{contents.appointment.name}</li>
		<li class="bg-orange-100 p-3"><button on:click={()=>displayAppointmentDetail(contents)}>⎋</button></li>
	{/if}
	{#if !contents.appointment}
		<li class="bg-blue-200 p-3">{contents.starttime}</li>
		<li class="bg-blue-100 p-3">No appointment</li>
	{/if}
</div>
