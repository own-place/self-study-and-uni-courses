<script>
    export let data;
</script>

<section>
    <h2 class="text-center text-2xl">Appointments</h2>
</section>

<section class="items-center text-center flex mt-5">
    <table class="table-auto -collapse w-full">
        <thead>
            <tr>
                <th class="text-lg px-4 py-2"> Date </th>
				<th class="text-lg px-4 py-2"> Timeslot </th>
				<th class="text-lg px-4 py-2"> Name </th>
				<th class="text-lg px-4 py-2"> Breed </th>
				<th class="text-lg px-4 py-2"> State </th>
            </tr>
        </thead>
        <tbody>
            {#each data.data as item}
            <tr>
                <td class="px-4 py-2"> {item.theDateId} </td>
                <td class="px-4 py-2"> {item.timeslotId} </td>
                <td class="px-4 py-2"> {item.name} </td>
                <td class="px-4 py-2"> {item.breed} </td>
                <td class="px-4 py-2"> {item.state} </td>
            </tr>
            {/each}
        </tbody>
    </table>
</section>