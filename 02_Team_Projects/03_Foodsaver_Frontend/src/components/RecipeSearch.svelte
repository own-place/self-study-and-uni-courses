<script lang="ts">
    import { goto } from "$app/navigation";
    import { onDestroy, onMount } from "svelte";
    import { authStore } from "../lib/stores/authStore";
    import { pantryStore, categoriesStore } from "../lib/stores/pantryStore";
    import { derived, writable } from "svelte/store";
    import { API_KEY } from "../lib/index"; // Import the API key

    let pantry = [];
    let categories = [];
    let addManually = writable<boolean>(false);
    let warningMessage = writable<string>("");
    let category = writable<string>("");
    let selectedIngredient = writable<string>("");
    let weight = writable<number>(0);
    let selectedMeasurement = writable<string>("grams");
    let expirationDate = writable<string>("");
    const measurementUnits = ["grams", "milliliters", "pieces"];

    // Subscribe to the store to get pantry data
    const unsubscribe_pantry = pantryStore.subscribe((data) => {
        pantry = data;
    });

    const unsubscribe_categories = categoriesStore.subscribe((data) => {
        categories = data;
    });

    onDestroy(() => {
        // Unsubscribe to avoid memory leaks
        unsubscribe_pantry();
        unsubscribe_categories();
    });

    let searchActive = false;
    let selectedIngredients: string[] = [];
    let recipes: any[] = [];
    let seasonalRecipes: any[] = [];
    // Object to track the favorites status of each recipe
    let favoriteStates: { [key: string]: boolean } = {};
    let username = "";
    let user_id = 1;

    const visibleRecipeCount = 6;
    let currentRecipeIndex1 = 0;
    let currentRecipeIndex2 = 0;

    $: username = $authStore.user?.username || "Guest";

    authStore.subscribe((state) => {
        console.log("Auth store state in home page: ", state);
        user_id = state.user?.id || 1;
        console.log("user id is: ", user_id);
    });

    const searchRecipes = async () => {
        if (!selectedIngredients.length) {
            alert(
                "Please select at least one ingredient to search for recipes.",
            );
        } else {
            const ingredientsParam = selectedIngredients.join(",");
            goto(`/search?ingredients=${ingredientsParam}`);
        }
    };

    // display ingredients in the pantry
    async function fetchPantryItems() {
        try {
            const response = await fetch(
                `http://localhost:4010/pantry?user_id=${user_id}`,
            );
            const data = await response.json();
            if (response.ok) {
                pantry = data.pantryItems;
                categories = data.categories;
                categoriesStore.set(data.categories.map((cat) => cat.category));
                pantryStore.set(pantry);
                checkExpiredIngredients();
            } else {
                console.error("Error fetching pantry items:", data.error);
            }
        } catch (error) {
            console.error("Error fetching pantry items:", error);
        }
    }

    const removeIngredient = async (name): Promise<void> => {
        try {
            const response = await fetch(
                `http://localhost:4010/pantry/delete/${name}?user_id=${user_id}`,
                {
                    method: "DELETE",
                },
            );

            const data = await response.json();

            if (response.ok) {
                console.log("Ingredient removed successfully:", data);

                // Remove the ingredient from the pantry array in the frontend
                pantry = pantry.filter((item) => item.name !== name);
                pantryStore.set(pantry); // Update the store with the new array

                console.log("Updated pantry in frontend:", pantry);
            } else {
                warningMessage.set(
                    `Error removing ingredient: ${name}. ${data.error}`,
                );
            }
        } catch (error) {
            warningMessage.set(
                `Error removing ingredient: ${name}. ${error.message}`,
            );
        }
    };

    async function checkExpiredIngredients() {
        const now = new Date().getTime();
        for (const item of pantry) {
            if (new Date(item.expiration_date).getTime() < now) {
                await removeIngredient(item.name);
                warningMessage.set(
                    `The ingredient "${item.name}" went bad. :(`,
                );
            }
        }
    }

    // Recipe navigation functions for first section
    const previousRecipes1 = () => {
        if (currentRecipeIndex1 > 0) {
            currentRecipeIndex1 -= 1;
        }
    };

    const nextRecipes1 = () => {
        if (currentRecipeIndex1 + visibleRecipeCount < recipes.length) {
            currentRecipeIndex1 += 1;
        }
    };

    // Recipe navigation functions for seasonal recipes
    const previousRecipes2 = () => {
        if (currentRecipeIndex2 > 0) {
            currentRecipeIndex2 -= 1;
        }
    };

    const nextRecipes2 = () => {
        if (currentRecipeIndex2 + visibleRecipeCount < seasonalRecipes.length) {
            currentRecipeIndex2 += 1;
        }
    };

    // Sort the pantry items by expiration date
    const sortedPantry = derived(pantryStore, ($pantry) => {
        if (!$pantry || !$pantry.pantryItems) {
            return [];
        }

        // Extract and sort pantry items by expiration date
        const sortedPantryItems = $pantry.pantryItems
            .slice() // Creates a shallow copy of the array
            .sort(
                (a, b) =>
                    new Date(a.expiration_date).getTime() -
                    new Date(b.expiration_date).getTime(),
            );

        return sortedPantryItems;
    });

    // Filter only the pantry items without categories
    const filteredPantry = derived(pantryStore, ($pantry) => {
        if (!$pantry || !$pantry.pantryItems) {
            return [];
        }

        // Extract pantry items without categories
        const filteredPantryItems = $pantry.pantryItems;

        return filteredPantryItems;
    });

    // Reactive variables
    const visibleIngredientCount = 5; // Number of ingredients visible at a time
    const switchingIngredients = 1; //Number of ingredients switched each time the arrow is clicked
    const maxExpiredIngredients = 50; //Max number of ingredients stored in the home's expiring ingredients
    let currentIngredientIndex = 0; // Initial index

    // Ingredients list
    const nearestExpiringIngredients = derived(
        sortedPantry,
        ($sortedPantry) => {
            let result = [];
            let count = 0;

            for (let ingredient of $sortedPantry) {
                if (count >= maxExpiredIngredients) break;
                result.push(ingredient);
                count++;
            }

            return result;
        },
    );

    // Function to go to previous ingredients
    const previousIngredients = () => {
        if (currentIngredientIndex > 0) {
            currentIngredientIndex -= switchingIngredients; // Move backwards in blocks of switchingIngredients (1)
        }
    };

    // Function to go to the next ingredients
    const nextIngredients = () => {
        if (
            currentIngredientIndex + switchingIngredients <
            nearestExpiringIngredients.length
        ) {
            currentIngredientIndex += switchingIngredients; // Move backwards in blocks of switchingIngredients (1)
        }
    };

    // Subscribe to nearestExpiringIngredients and fetch recipes whenever it changes
    nearestExpiringIngredients.subscribe(async (ingredients) => {
        if (ingredients.length > 0) {
            await fetchRecipes(ingredients);
        } else {
            recipes = [];
        }
    });

    // Fetch recipes based on selected ingredients
    async function fetchRecipes(pantry) {
        const ingredients = pantry.map((item) => item.name).join(",");
        console.log("Fetching recipes with ingredients:", ingredients);
        recipes = [];

        try {
            const response = await fetch(
                `https://api.spoonacular.com/recipes/findByIngredients?ingredients=${ingredients}&number=8&apiKey=${API_KEY}`,
            );
            if (response.ok) {
                const fetchedRecipes = await response.json();
                recipes = fetchedRecipes.map((recipe) => ({
                    id: recipe.id,
                    title: recipe.title,
                    image: recipe.image,
                }));
                console.log("Fetched recipes:", recipes);
            } else {
                console.error("Failed to fetch recipes:", response.statusText);
            }
        } catch (error) {
            console.error("Error fetching recipes:", error);
        }
    }

    // Fetch seasonal recipes
    async function fetchSeasonalRecipes() {
        try {
            const month = new Date().getMonth() + 1;
            let seasonalIngredient = "";

            if (month >= 3 && month <= 5) {
                seasonalIngredient = "asparagus";
            } else if (month >= 6 && month <= 8) {
                seasonalIngredient = "tomato";
            } else if (month >= 9 && month <= 11) {
                seasonalIngredient = "pumpkin";
            } else {
                seasonalIngredient = "potato";
            }

            console.log(
                "Fetching seasonal recipes with ingredient:",
                seasonalIngredient
            );

            const response = await fetch(
                `https://api.spoonacular.com/recipes/findByIngredients?ingredients=${seasonalIngredient}&number=8&apiKey=${API_KEY}`
            );

            if (response.ok) {
                const fetchedRecipes = await response.json();
                seasonalRecipes = fetchedRecipes.map((recipe) => ({
                    id: recipe.id,
                    title: recipe.title,
                    image: recipe.image,
                }));

                console.log("Fetched seasonal recipes:", seasonalRecipes);
            } else {
                console.error(
                    "Failed to fetch seasonal recipes:",
                    response.statusText
                );
            }
        } catch (error) {
            console.error("Error fetching seasonal recipes:", error);
        }
    }

 // Función para verificar el estado de favorito de una receta
 async function checkFavoriteStatus(recipe_id: string) {
        try {
            const response = await fetch(
                `http://localhost:3012/check-favorite/${recipe_id}?user_id=${user_id}`
            );

            if (response.ok) {
                const data = await response.json();
                favoriteStates[recipe_id] = data.isFavorite;
            } else {
                console.error("Error al verificar el estado de favorito");
            }
        } catch (error) {
            console.error("Error al verificar el estado de favorito:", error);
        }
    }

    // Alternar el estado de favorito para una receta específica
 export async function toggleFavorite(recipe_id: string) {
        if (favoriteStates[recipe_id]) {
            const response = await fetch(
                `http://localhost:3012/favorites/${recipe_id}`,
                {
                    method: "DELETE",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ user_id }),
                }
            );

            if (response.ok) {
                alert("This recipe is removed from favorites");
                favoriteStates[recipe_id] = false;
            } else {
                const error = await response.json();
                alert(`Failed to remove from favorites: ${error.error}`);
            }
        } else {
            const response = await fetch("http://localhost:3012/favorites", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ recipe_id, user_id }),
            });

            if (response.ok) {
                alert("This recipe is added to favorites");
                favoriteStates[recipe_id] = true;
            } else {
                const error = await response.json();
                alert(`Failed to add to favorites: ${error.error}`);
            }
        }

        checkFavoriteStatus(recipe_id); // Actualizar el estado después de cambiarlo
    }


 // Ejecutar al montar el componente
 onMount(async () => {
        await fetchSeasonalRecipes();
        await checkFavoritesForSeasonalRecipes();

        //await fetchRecipes(expiringIngredients);
        await checkFavoritesForExpiringRecipes();
    });

async function checkFavoritesForSeasonalRecipes() {
        for (const recipe of seasonalRecipes) {
            await checkFavoriteStatus(recipe.id);
        }
    }

// Verificar el estado de favoritos para las recetas expiring
async function checkFavoritesForExpiringRecipes() {
    await delay(500);
        for (const recipe of recipes) {
            await checkFavoriteStatus(recipe.id);
        }
    }

 // Función para pausar la ejecución por un tiempo específico
 function delay(ms: number) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    }

    function goToRecipeDetails(recipeId) {
        goto(`/recipe/${recipeId}`);
    }

    const saveIngredientDetails = async (): Promise<void> => {
        const newItem = {
            name: $selectedIngredient,
            quantity: $weight,
            measurement: $selectedMeasurement,
            expiration_date: $expirationDate,
            category: $category,
            user_id: user_id,
        };

        if (
            new Date(newItem.expiration_date).getTime() < new Date().getTime()
        ) {
            warningMessage.set("Please input a valid expiration date.");
            return;
        }

        try {
            const response = await fetch(
                `http://localhost:4010/pantry/add?user_id=${user_id}`,
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(newItem),
                },
            );

            const data = await response.json();

            if (response.ok) {
                console.log("Ingredient added successfully:", data);
                location.reload(); // Refresh the page
            } else {
                console.error("Error adding ingredient:", data.error);
            }

            selectedIngredient.set("");
            weight.set(0);
            expirationDate.set("");
            addManually.set(false);
            category.set("");
        } catch (error) {
            console.error("Error saving ingredient:", error);
        }
    };

    onMount(() => {
        fetchPantryItems();
        nearestExpiringIngredients.subscribe((value) => {
            console.log("Nearest expiring ingredients:", value);
        });
    });
</script>

<div class="container mx-auto mt-8 px-4 lg:px-6 text-center">
    <h2 class="text-3xl font-bold text-green-800 italic mb-6">
        Hello, {username}!
    </h2>

    <!-- Search Bar Section -->
    <div
        class="search-bar-container flex items-center justify-center w-full relative mb-8"
    >
        <div class="ml-4 mr-4">
            <button
                class="px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300"
                on:click={() => addManually.set(true)}
            >
                Add Ingredients
            </button>
        </div>
        <div class="relative flex-grow max-w-2xl">
            <div class="relative">
                <input
                    type="text"
                    bind:value={selectedIngredients}
                    on:focus={() => (searchActive = true)}
                    class="w-full p-4 pr-12 rounded-md shadow-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500"
                />
                <button
                    on:click={searchRecipes}
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center justify-center"
                >
                    <svg
                        class="w-6 h-6 text-gray-500 hover:text-green-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 15l5.5 5.5M19 11a8 8 0 10-8 8 8 8 0 008-8z"
                        />
                    </svg>
                </button>

                <!-- Dropdown for pantry items -->
                {#if searchActive}
                    <div
                        class="dropdown absolute top-full left-0 mt-2 bg-white shadow-md border border-gray-200 rounded-md w-full z-50 p-4"
                    >
                        <h3 class="font-bold mb-2">Select Ingredients</h3>
                        <ul>
                            {#each $filteredPantry as item, index (item.id ? item.id : index)}
                                <li class="flex items-center mb-2">
                                    <label class="flex items-center space-x-2">
                                        <input
                                            type="checkbox"
                                            bind:group={selectedIngredients}
                                            value={item.name}
                                            class="mr-2"
                                        />
                                        <span>{item.name}</span>
                                    </label>
                                </li>
                            {/each}
                        </ul>
                        <button
                            on:click={() => (searchActive = false)}
                            class="button-secondary mt-2">Close</button
                        >
                    </div>
                {/if}
            </div>
        </div>
    </div>

    <div class="expiring-ingredients-section mb-8 text-left">
        <h3 class="text-2xl font-semibold mb-4">Ingredients Expiring Soon</h3>
        <div class="flex items-center space-x-4">
            <!-- Left Arrow Button -->
            <button
                on:click={previousIngredients}
                class="p-2 rounded-full border border-gray-300 bg-white hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed hidden sm:block"
                disabled={currentIngredientIndex === 0}
            >
                <svg
                    class="w-4 h-4"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </button>

            <!-- List of Ingredients -->
            <div class="flex items-center space-x-4 h-60 overflow-x-auto">
                {#each $nearestExpiringIngredients.slice(currentIngredientIndex, currentIngredientIndex + visibleIngredientCount) as item}
                    {#if (new Date(item.expiration_date).getTime() - new Date().getTime()) / (1000 * 60 * 60 * 24) <= 3}
                    <div class="flex flex-col items-center space-y-2">
                        <div
                        class="bg-gray-200 w-16 h-16 rounded-full flex items-center justify-center"
                      >
                      <img
                      src="/fridge-solid-24.png"
                      alt={item.name}
                      class="w-10 h-10 object-cover"
                    />
                      </div>
                        <!-- Ingredient Name -->
                        <span class="text-gray-700 text-sm">{item.name}</span>
                        <!-- Ingredient Weight and Measurement -->
                        <span class="text-gray-500 text-xs">
                          {item.quantity}
                          {#if item.measurement === "grams"}
                            g
                          {:else if item.measurement === "milliliters"}
                            ml
                          {:else if item.measurement === "pieces"}
                            pcs
                          {/if}
                        </span>
                        <!-- Ingredient Expiration Date -->
                        <span class="text-gray-500 text-xs"
                          >Expires: {item.expiration_date}</span
                        >
                        {#if (new Date(item.expiration_date).getTime() - new Date().getTime()) / (1000 * 60 * 60) <= 24}
                          <span class="text-red-500 text-xs">Expiring today!</span>
                        {/if}
                    </div>
                    {/if}
                {/each}
            </div>

            <!-- Right Arrow Button -->
            <button
                on:click={nextIngredients}
                class="p-2 rounded-full border border-gray-300 bg-white hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed hidden sm:block"
                disabled={currentIngredientIndex + visibleIngredientCount >=
                    $nearestExpiringIngredients.length}
            >
                <svg
                    class="w-4 h-4"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                    />
                </svg>
            </button>
        </div>
    </div>

    <!-- Recipes Section -->
    <div class="flex flex-col space-y-8">
        <div class="container mx-auto mt-8 px-4 lg:px-6 text-left">
            <h3 class="text-2xl font-semibold mb-4">
                Recipes with your expiring ingredients:
            </h3>
            {#if recipes.length > 0}
                <div class="flex items-center space-x-4 overflow-x-auto">
                    <button
                        on:click={previousRecipes1}
                        class="p-2 rounded-full border border-gray-300 bg-white hover:bg-gray-100 hidden sm:block"
                    >
                        <svg
                            class="w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>
                    </button>
                    <div class="flex space-x-4">
                        {#each recipes.slice(currentRecipeIndex1, currentRecipeIndex1 + visibleRecipeCount) as recipe}
                            <div
                                class="recipe-card border p-4 rounded-lg text-center shadow-md w-40 relative"
                            >
                                <img
                                    src={recipe.image}
                                    alt={recipe.title}
                                    class="w-full h-24 object-cover rounded-md mb-2"
                                    on:click={() =>
                                        goToRecipeDetails(recipe.id)}
                                />
                                <p class="font-semibold text-lg mb-3">
                                    {recipe.title}
                                </p>
                                <img
                                    src={favoriteStates[recipe.id] ? "/solid-heart.png" : "/blank-heart.png"}
                                    alt="Favorite"
                                    class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-6 h-6 cursor-pointer"
                                    on:click={() => toggleFavorite(recipe.id)}
                                />
                            </div>
                        {/each}
                    </div>
                    <button
                        on:click={nextRecipes1}
                        class="p-2 rounded-full border border-gray-300 bg-white hover:bg-gray-100 hidden sm:block"
                    >
                        <svg
                            class="w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>
                    </button>
                </div>
            {:else}
                <p class="text-gray-600">
                    No recipes found for your expiring ingredients. Try adding
                    more items to your pantry.
                </p>
            {/if}
        </div>

        <!-- Seasonal Recipes Section -->
        <div class="container mx-auto mt-8 px-4 lg:px-6 text-left">
            <h3 class="text-2xl font-semibold mb-4">Seasonal Recipes:</h3>
            {#if seasonalRecipes.length > 0}
                <div class="flex items-center space-x-4 overflow-x-auto">
                    <button
                        on:click={previousRecipes2}
                        class="p-2 rounded-full border border-gray-300 bg-white hover:bg-gray-100 hidden sm:block"
                    >
                        <svg
                            class="w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>
                    </button>
                    <div class="flex space-x-4">
                        {#each seasonalRecipes.slice(currentRecipeIndex2, currentRecipeIndex2 + visibleRecipeCount) as recipe}
                            <div
                                class="recipe-card border p-4 rounded-lg text-center shadow-md w-40 relative"
                            >
                                <img
                                    src={recipe.image}
                                    alt={recipe.title}
                                    class="w-full h-24 object-cover rounded-md mb-2"
                                    on:click={() =>
                                        goToRecipeDetails(recipe.id)}
                                />
                                <p class="font-semibold text-lg mb-2">
                                    {recipe.title}
                                </p>
                                <img
                                    src={favoriteStates[recipe.id] ? "/solid-heart.png" : "/blank-heart.png"}
                                    alt="Favorite"
                                    class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-6 h-6 cursor-pointer"
                                    on:click={() => toggleFavorite(recipe.id)}
                                />
                            </div>
                        {/each}
                    </div>
                    <button
                        on:click={nextRecipes2}
                        class="p-2 rounded-full border border-gray-300 bg-white hover:bg-gray-100 hidden sm:block"
                    >
                        <svg
                            class="w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>
                    </button>
                </div>
            {:else}
                <p class="text-gray-600">No seasonal recipes available.</p>
            {/if}
        </div>
    </div>
</div>

{#if $addManually}
    <div
        class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50"
    >
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full relative">
            {#if $warningMessage}
                <div
                    class="absolute inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50"
                >
                    <div
                        class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full"
                    >
                        <h2 class="text-2xl font-bold text-red-600 mb-4">
                            Warning
                        </h2>
                        <p class="text-gray-700 mb-4">{$warningMessage}</p>
                        <div class="flex justify-end">
                            <button
                                on:click={() => warningMessage.set("")}
                                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600"
                            >
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            {/if}
            <h2 class="text-2xl font-bold text-green-600 mb-4">
                Add an Ingredient
            </h2>
            <div class="mb-4">
                <select
                    bind:value={$category}
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
                >
                    <option value="">Select a category</option>
                    {#each categories as category}
                        <option value={category}>{category}</option>
                    {/each}
                </select>Category
            </div>
            <div class="mb-4">
                <input
                    type="string"
                    bind:value={$selectedIngredient}
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
                />Name
            </div>
            <div class="mb-4">
                <input
                    type="number"
                    bind:value={$weight}
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
                />Select the amount
            </div>
            <div class="mb-4">
                <select
                    bind:value={$selectedMeasurement}
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
                >
                    {#each measurementUnits as unit}
                        <option value={unit}>{unit}</option>
                    {/each}
                </select>Measurement
            </div>
            <div class="mb-4">
                <input
                    type="date"
                    bind:value={$expirationDate}
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
                />Select the expiration date
            </div>
            <div class="flex justify-end space-x-4">
                <button
                    on:click={() => addManually.set(false)}
                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600"
                >
                    Cancel
                </button>
                <button
                    on:click={saveIngredientDetails}
                    class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
                >
                    Save
                </button>
            </div>
        </div>
    </div>
{/if}

<style>
    .dropdown {
        max-height: 200px;
        overflow-y: auto;
    }

    .container {
        max-width: 1200px;
    }

    .ingredient-item {
        width: 48px;
        height: 48px;
    }

    .recipe-card {
        width: 160px;
    }
</style>
