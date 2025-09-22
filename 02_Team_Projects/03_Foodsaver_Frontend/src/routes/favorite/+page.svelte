<script lang="ts">
    import { authStore } from './../../lib/stores/authStore.js';
    import { onMount } from "svelte";
    import { goto } from "$app/navigation";
    import { API_KEY } from '../../lib/index.js';

    let user_id = 1;
    authStore.subscribe((state) => {
        console.log("Auth store state in home page: ", state);
        user_id = state.user?.id || 1;
        console.log("user id is: ", user_id);
    });

    let favoriteRecipeIds = [];
    let recipes = [];

    // get all favorite recipes' IDs
    async function fetchFavoriteRecipeIds() {
        const response = await fetch(
            `http://localhost:3012/favorite-recipe-ids?user_id=${user_id}`,
        );

        if (response.ok) {
            const ids = await response.json();
            favoriteRecipeIds = [...ids];
            await fetchRecipes();
        } else {
            console.error("Failed to fetch favorite recipe IDs");
        }
    }

    // fetch recipe details
    async function fetchRecipes() {
        console.log("Fetching recipes with IDs:", favoriteRecipeIds);

        const requests = favoriteRecipeIds.map((id) =>
            fetch(
                `https://api.spoonacular.com/recipes/${id}/information?apiKey=${API_KEY}`,
            ),
        );

        const responses = await Promise.all(requests);
        const recipesData = await Promise.all(
            responses.map(async (response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    console.error(
                        `Error fetching recipe ID ${id}:`,
                        response.statusText,
                    );
                    return null;
                }
            }),
        );

        recipes = recipesData.filter(Boolean);
        console.log("Fetched recipes:", recipes);
    }

    onMount(fetchFavoriteRecipeIds);

    // jump to recipe details page
    function goToRecipeDetails(recipeId: number) {
        goto(`/recipe/${recipeId}`);
    }
</script>

<!-- Main Content -->
<div class="container mx-auto mt-6 p-6">
    <h1 class="text-3xl font-bold mb-6">Your Favorite Recipes</h1>

    <!-- Display Recipes -->
    {#if recipes.length > 0}
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
        >
            {#each recipes as recipe}
                <div
                    class="recipe-card border p-4 rounded-lg text-center shadow hover:shadow-lg transition-all"
                >
                    <img
                        src={recipe.image}
                        alt={recipe.title}
                        class="w-full h-32 object-cover rounded-md mb-2"
                        on:click={() => goToRecipeDetails(recipe.id)}
                    />
                    <p class="font-semibold text-lg">{recipe.title}</p>
                </div>
            {/each}
        </div>
    {:else}
        <p>You don't have any favorite recipes.</p>
    {/if}
</div>

<style>
    .container {
        max-width: 1200px;
    }

    .recipe-card {
        border: 1px solid #ddd;
        padding: 1rem;
        border-radius: 8px;
        text-align: center;
    }

    .recipe-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    .recipe-card p {
        margin-top: 1rem;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .recipe-card button {
        margin-top: 1rem;
    }
</style>
