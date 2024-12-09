<script>
	import { onMount } from 'svelte';

	let data = [];
	let pets = [];
	let allTypes = [];
	let selectedtype = '';

	onMount(async () => {
		try {
			const res = await fetch('http://localhost:3010/pets/');
			const urlArr = await res.json();
			const fetchEach = urlArr.map(async (url) => {
				const fetchEachData = await fetch(`http://localhost:3010${url}`);
				return await fetchEachData.json();
			});
			data = await Promise.all(fetchEach);

			// update pets
			pets = data;

			// format each pet's type and remove duplicates
			allTypes = [...new Set(pets.map(pet => formatType(pet.type)))]; 
		} catch (error) {
			console.error("Error fetching pets:", error);
		}
	});

	// Function to format type (first letter uppercase, rest lowercase)
	const formatType = (type) => {
		return type.charAt(0).toUpperCase() + type.slice(1).toLowerCase();
	};

	const chooseAType = (type) => {
		// check if a type is selected
		console.log('Selected type:', type); 
		// filter pets based on type
		if (type === '') {
			pets = data;
		} else {
			pets = data.filter((pet) => formatType(pet.type) === type); // Ensure consistent comparison
		}
	};
</script>

<!-- only rendering when allTpyes has values -->
{#if allTypes.length > 0}
	<select class="mb-6 lg:mb-10" bind:value={selectedtype} on:change={() => chooseAType(selectedtype)}>
		<option value="" selected>Choose A Type</option>
		{#each allTypes as type (type)}
			<option value={type}>{type}</option>
		{/each}
	</select>
{/if}

<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
	{#each pets as pet}
		<ul class="bg-blue-200 p-3 lg:p-4 rounded-lg">
			<li>{pet.id}</li>
			<li>{pet.name}</li>
			<li>{pet.type}</li>
		</ul>
	{/each}
</div>
