<script lang="ts">
	import { authStore } from './../lib/stores/authStore.js';
	import { goto } from "$app/navigation";
	import { writable } from "svelte/store";

	let title = ''; // Recipe name
	let content = ''; // Recipe details (ingredients and instructions)
	let photo: File | null = null; // Recipe photo file
	let photoPreview = writable<string | null>(null); // For previewing the uploaded photo
	let user_id = 1; // Default user ID (fallback)

	authStore.subscribe((state) => {
		user_id = state.user?.id || 1;
	});

	// Handle form submission to create a new recipe
	async function handleSubmit() {
    const formData = new FormData();
    formData.append("user_id", user_id.toString());
    formData.append("title", title);
    formData.append("content", content);
    if (photo) {
        formData.append("photo", photo);
    }

    // Debug FormData
    for (let [key, value] of formData.entries()) {
        console.log(`${key}:`, value);
    }

    try {
        const response = await fetch("http://localhost:3020/forum", {
            method: "POST",
            body: formData,
        });

        const responseData = await response.json();
        console.log("Response from server:", responseData);

        if (response.ok) {
            goto("/community");
        } else {
            throw new Error(responseData.error || "Failed to create recipe");
        }
    } catch (error) {
        console.error('Error creating recipe:', error);
        alert(`Failed to create recipe: ${error.message}`);
    }
}


	// Handle cancel button (navigate back to community/recipes page)
	function handleCancel() {
		goto("/community");
	}

	// Handle photo input and generate a preview
	function handlePhotoChange(event: Event) {
		const input = event.target as HTMLInputElement;
		if (input.files && input.files[0]) {
			photo = input.files[0];
			const reader = new FileReader();
			reader.onload = (e) => {
				photoPreview.set(e.target?.result as string);
			};
			reader.readAsDataURL(photo);
			console.log("Selected photo:", photo);
		} else {
			photoPreview.set(null);
			photo = null;
		}
	}
</script>

<!-- Create Recipe Form -->
<div class="container mx-auto mt-6 p-6">
	<h1 class="text-green-700 text-3xl font-bold mb-6">Create a New Recipe</h1>

	<form on:submit|preventDefault={handleSubmit} class="space-y-4">
		<div>
			<label for="title" class="block text-sm font-medium text-gray-700">Recipe Name</label>
			<input
				id="title"
				type="text"
				bind:value={title}
				class="mt-1 block w-full border border-gray-300 rounded-lg p-2"
				placeholder="Enter recipe name"
				required
			/>
		</div>

		<div>
			<label for="content" class="block text-sm font-medium text-gray-700">Recipe Details</label>
			<textarea
				id="content"
				bind:value={content}
				class="mt-1 block w-full border border-gray-300 rounded-lg p-2"
				placeholder="Enter ingredients and instructions"
				required
			></textarea>
		</div>

		<div>
			<label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
			<input
				id="photo"
				type="file"
				class="mt-1 block w-full border border-gray-300 rounded-lg p-2"
				accept="image/*"
				on:change={handlePhotoChange}
			/>
			{#if $photoPreview}
				<img src={$photoPreview} alt="Photo preview" class="mt-2 rounded-lg max-h-48" />
			{/if}
		</div>

		<div class="flex justify-between mt-4">
			<button
				type="submit"
				class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600"
			>
				Create Recipe
			</button>

			<button
				type="button"
				on:click={handleCancel}
				class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600"
			>
				Cancel
			</button>
		</div>
	</form>
</div>

<style>
	.container {
		max-width: 600px;
		margin: 0 auto;
	}

	input,
	textarea {
		font-size: 1rem;
		padding: 0.5rem;
		border-radius: 0.375rem;
		border: 1px solid #ccc;
	}

	button:hover {
		transition: background-color 0.2s ease-in-out;
	}

	img {
		display: block;
		max-width: 100%;
		object-fit: cover;
	}
</style>
