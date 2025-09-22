<script lang="ts">
    import { onMount } from "svelte";
    import { goto } from "$app/navigation";

    let posts = []; // Backend naming retained

    // Fetch all recipes (posts) from the backend
    async function fetchRecipes() {
        const response = await fetch("http://localhost:3020/forum"); // Endpoint for posts
        if (response.ok) {
            posts = await response.json();
        } else {
            console.error("Failed to fetch recipes");
        }
    }

    onMount(fetchRecipes);

    // Navigate to the recipe creation page
    function goToCreateRecipe() {
        goto("/community/create"); // Adjust route if necessary
    }
</script>

<!-- Main Content -->
<div class="container mx-auto mt-6 p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-700">Recipes</h1>
        <button
            class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600"
            on:click={goToCreateRecipe}
        >
            Add New Recipe
        </button>
    </div>

    <!-- Display Recipes -->
    {#if posts.length > 0}
        <div class="space-y-6">
            {#each posts as post}
                <div
                    class="recipe-card border p-4 rounded-lg shadow-md hover:shadow-lg transition-all"
                    on:click={() => goto(`/community/${post.id}`)}
                >
                    <h2 class="text-xl font-semibold">{post.title}</h2> <!-- Recipe name -->
                    <p class="text-gray-700 mt-2">{post.content}</p> <!-- Recipe details -->
                    <p class="text-sm text-gray-500 mt-2">
                        Posted on: {new Date(post.created_at).toLocaleString()}
                    </p>
                </div>
            {/each}
        </div>
    {:else}
        <p>Loading recipes...</p>
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

    .recipe-card h2 {
        margin-bottom: 0.5rem;
    }

    .recipe-card p {
        margin-bottom: 0.5rem;
    }
</style>
