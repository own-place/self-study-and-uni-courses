<script lang="ts">
	import { authStore } from './../../../lib/stores/authStore.js';
	import { onMount } from "svelte";
	import { page } from "$app/stores";
	import { goto } from "$app/navigation";
let post_id;

const unsubscribe = page.subscribe(($page) => {
   post_id = $page.url.searchParams.get('post_id'); // or use $page.params if defined
});
onDestroy(unsubscribe);

	let post = null; // Keep backend naming
	let isEditing = false;
	let updatedTitle = ""; // Recipe name
	let updatedContent = ""; // Recipe details (ingredients and instructions)

	let user_id = 1;
	authStore.subscribe((state) => {
		user_id = state.user?.id || 1;
	});

	// Fetch the recipe (post) based on the recipe ID
	async function fetchRecipe() {
		 // post_id remains as the backend uses this naming
		const response = await fetch(`http://localhost:3020/forum/${post_id}`);

		if (response.ok) {
			post = await response.json();
			updatedTitle = post.title; // Map 'title' to recipe name
			updatedContent = post.content; // Map 'content' to recipe details
		} else {
			console.error("Failed to fetch recipe");
		}
	}

	// Check if the current user can edit or delete the recipe
	function canEditOrDelete() {
		return post?.user_id === user_id;
	}

	// Update the recipe (post)
	async function updateRecipe() {
		
		const response = await fetch(`http://localhost:3020/forum/${post_id}`, {
			method: "PUT",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify({
				title: updatedTitle, // Recipe name
				content: updatedContent, // Recipe details
			}),
		});

		if (response.ok) {
			post.title = updatedTitle;
			post.content = updatedContent;
			isEditing = false;
		} else {
			console.error("Failed to update recipe");
		}
	}

	// Delete the recipe (post)
	async function deleteRecipe() {
		
		const response = await fetch(`http://localhost:3020/forum/${post_id}`, {
			method: "DELETE",
		});

		if (response.ok) {
			goto("/community");
		} else {
			console.error("Failed to delete recipe");
		}
	}

	onMount(fetchRecipe);
</script>

<!-- Recipe Details -->
<div class="container mx-auto mt-6 p-6">
	{#if post}
    <div class="recipe-card border p-4 rounded-lg shadow-md">
        {#if isEditing}
            <!-- Edit Mode -->
            <h1 class="text-3xl text-green-700 font-bold mb-4">Edit Recipe</h1>
            <input
                type="text"
                class="w-full p-2 border border-gray-300 rounded mb-4"
                bind:value={updatedTitle}
                placeholder="Recipe Name"
            />
            <textarea
                class="w-full p-2 border border-gray-300 rounded mb-4"
                rows="6"
                bind:value={updatedContent}
                placeholder="Recipe Details (e.g., ingredients and instructions)"
            ></textarea>
            <div class="flex gap-4">
                <button
                    class="bg-green-500 text-white px-4 py-2 rounded"
                    on:click={updateRecipe}
                >
                    Save
                </button>
                <button
                    class="bg-gray-500 text-white px-4 py-2 rounded"
                    on:click={() => (isEditing = false)}
                >
                    Cancel
                </button>
            </div>
        {:else}
            <!-- View Mode -->
            <h1 class="text-3xl font-bold">{post.title}</h1> <!-- Recipe name -->

            {#if post.photo_url}
                <!-- Display the photo -->
                <img
                    src={`http://localhost:3020${post.photo_url}`}
                    alt="Recipe photo"
                    class="w-full max-h-64 object-cover rounded-lg mt-4"
                />
            {/if}

            <h2 class="text-xl font-semibold mt-4">Recipe Details:</h2>
            <p class="text-lg text-gray-700 mt-2">{post.content}</p> <!-- Recipe details -->
            <p class="text-sm text-gray-500 mt-4">
                Posted on: {new Date(post.created_at).toLocaleString()}
            </p>

            <div class="flex gap-4 mt-4">
                {#if canEditOrDelete()}
                    <!-- Only show Edit and Delete if the user owns the recipe -->
                    <button
                        class="bg-yellow-500 text-white px-4 py-2 rounded"
                        on:click={() => (isEditing = true)}
                    >
                        Edit
                    </button>
                    <button
                        class="bg-red-500 text-white px-4 py-2 rounded"
                        on:click={deleteRecipe}
                    >
                        Delete
                    </button>
                {/if}
                <button
                    class="bg-gray-500 text-white px-4 py-2 rounded"
                    on:click={() => goto("/community")}
                >
                    Back to Recipes
                </button>
            </div>
        {/if}
    </div>
{:else}
    <p>Loading recipe details...</p>
{/if}

</div>

<style>
	.container {
		max-width: 1200px;
	}

	.recipe-card {
		background-color: white;
		padding: 1rem;
		border-radius: 8px;
	}

	.recipe-card h1,
	.recipe-card h2 {
		margin-bottom: 1rem;
	}

	.recipe-card p {
		margin-bottom: 1rem;
	}

	input,
	textarea {
		font-size: 1rem;
		padding: 0.5rem;
		border-radius: 0.375rem;
		border: 1px solid #ccc;
	}
</style>
