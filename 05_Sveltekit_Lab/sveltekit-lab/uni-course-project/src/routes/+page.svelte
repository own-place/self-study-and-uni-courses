<script>
    import { setContext } from "svelte";
    import TimeSlots from "$lib/components/TimeSlots.svelte";
    import Client from "$lib/components/Client.svelte";
    import Clients from "$lib/components/Clients.svelte";
    import Date from "$lib/components/Date.svelte";

    setContext('apiReference', {
		mainUrl: 'http://localhost:3015/api/v1/'
	});
</script>

<div class="container w-full mx-auto">
    <section class="mt-4">
        <h2 class="text-6xl">
            A<span class="inline-block bg-blue-100 rounded-lg">ppointments&nbsp;</span>
        </h2>
        <Date />
    </section>
    <section class="flex flex-col lg:flex-row mt-5">
        <div class="basis-4/6 bg-gray-100 rounded-lg p-10 lg:mr-8">
            <TimeSlots />
        </div>
        <div class="basis-2/6 bg-gray-100 rounded-lg p-10 lg:mr-8">
            <Client />
        </div>
    </section>
</div>

<div class="container w-full mx-auto">
    <section class="mt-4">
		<h2 class="text-4xl">
			C<span class="inline-block bg-blue-100 rounded-lg">lients&nbsp;</span>
		</h2>
	</section>
    <section class="flex flex-col lg:flex-row mt-5">
        <div class="basis-4/6 bg-gray-100 rounded-lg p-10 lg:mr-8">
            <Clients />
        </div>
    </section>
</div>

<style>
</style>
