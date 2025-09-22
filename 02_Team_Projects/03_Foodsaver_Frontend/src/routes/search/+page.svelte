<script lang="ts">
  import { onMount } from "svelte";
  import { page } from "$app/stores";
  import { goto } from "$app/navigation";
  import { API_KEY } from "../../lib/index"; // Import the API key

  // Define the recipe type
  type Recipe = {
    id: number;
    title: string;
    image: string;
    isVegetarian: boolean;
    isGlutenFree: boolean;
  };

  let recipes: Recipe[] = []; // Explicitly set the type for recipes
  let filteredRecipes: Recipe[] = []; // For filtered results
  let selectedIngredients: string[] = [];
  let isVegetarian = false; // Checkbox for Vegetarian filter
  let isGlutenFree = false; // Checkbox for Gluten-Free filter
  let searchParams: URLSearchParams;

  // Fetch recipes based on the selected ingredients from query parameters
  onMount(async () => {
    page.subscribe(($page) => {
        searchParams = new URLSearchParams($page.url.search);
    });

    selectedIngredients = searchParams.get("ingredients")?.split(",") || [];

    if (selectedIngredients.length) {
      try {
        const response = await fetch(
          `https://api.spoonacular.com/recipes/findByIngredients?ingredients=${selectedIngredients.join(
            ",",
          )}&number=3&apiKey=${API_KEY}`,
        );

        if (response.ok) {
          const data = await response.json();

          // Fetch detailed information for each recipe
          const detailedRecipes = await Promise.all(
            data.map(async (recipe: any) => {
              const detailsResponse = await fetch(
                `https://api.spoonacular.com/recipes/${recipe.id}/information?apiKey=${API_KEY}`,
              );

              if (!detailsResponse.ok) {
                console.error(
                  `Failed to fetch details for recipe ${recipe.id}`,
                );
                return null;
              }

              const details = await detailsResponse.json();

              return {
                id: recipe.id,
                title: recipe.title,
                image: recipe.image,
                isVegetarian: details.vegetarian,
                isGlutenFree: details.glutenFree,
              };
            }),
          );

          // Remove null recipes (in case some detailed fetches failed)
          recipes = detailedRecipes.filter((recipe) => recipe !== null);
          filteredRecipes = [...recipes]; // Initialize filteredRecipes with all fetched recipes
        } else {
          console.error("Failed to fetch recipes:", response.statusText);
        }
      } catch (error) {
        console.error("Error fetching recipes:", error);
      }
    }
  });

  function goToRecipeDetails(recipeId: number) {
    goto(`/recipe/${recipeId}`);
  }

  function goToFavorites() {
    goto(`/favorite`);
  }

  // Apply filters to the fetched recipes
  const applyFilters = (): void => {
    filteredRecipes = recipes.filter((recipe) => {
      const matchesVegetarian = isVegetarian ? recipe.isVegetarian : true;
      const matchesGlutenFree = isGlutenFree ? recipe.isGlutenFree : true;
      return matchesVegetarian && matchesGlutenFree;
    });
  };
</script>

<!-- Main Content -->
<div class="container mx-auto mt-6 p-6">
  <h1 class="text-3xl font-bold mb-6">Recipes with Your Ingredients</h1>

  <!-- Filters Section -->
  <div class="filters mb-4">
    <h3 class="font-bold text-lg mb-2">Filter Recipes</h3>
    <label class="inline-flex items-center mr-4">
      <input
        type="checkbox"
        bind:checked={isVegetarian}
        on:change={applyFilters}
      />
      <span class="ml-2">Vegetarian</span>
    </label>
    <label class="inline-flex items-center">
      <input
        type="checkbox"
        bind:checked={isGlutenFree}
        on:change={applyFilters}
      />
      <span class="ml-2">Gluten-Free</span>
    </label>
  </div>
</div>

<!-- Display Recipes -->
{#if filteredRecipes.length > 0}
  <div
    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
  >
    {#each filteredRecipes as recipe}
      <div
        class="recipe-card border p-4 rounded-lg text-center shadow hover:shadow-lg transition-all"
      >
        <img
          src={recipe.image}
          alt={recipe.title}
          class="w-full h-32 object-cover rounded-md mb-2 cursor-pointer"
          on:click={() => goToRecipeDetails(recipe.id)}
        />
        <p class="font-semibold text-lg">{recipe.title}</p>
      </div>
    {/each}
  </div>
{:else}
  <p>No recipes found. Try adjusting your search or filters.</p>
{/if}

<style>
  .container {
    max-width: 1200px;
  }
  .filters {
    text-align: left;
    margin-bottom: 1.5rem;
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
