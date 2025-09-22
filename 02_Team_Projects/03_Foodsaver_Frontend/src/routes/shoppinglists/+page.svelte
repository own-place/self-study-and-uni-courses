<script lang="ts">
    import { authStore } from './../../lib/stores/authStore.js';
    import { onMount } from "svelte";
    import { goto } from "$app/navigation";
    import { API_KEY } from '../../lib/index.js';

    let user_id = 1;
    let savedShoppingLists = [];
    let isLoading = true;
    let selectedList = null;

    authStore.subscribe((state) => {
        console.log("Auth store state in home page: ", state);
        user_id = state.user?.id || 1;
        console.log("user id is: ", user_id);
    });

    onMount(() => {
        fetchShoppingLists();
    });

    async function fetchShoppingLists() {
        try {
            const response = await fetch(`http://localhost:4053/shopping-lists?userId=${user_id}`);
            if (response.ok) {
                const lists = await response.json();

                for (let list of lists) {
                    if (list.recipe_id) {
                        const recipeData = await fetchRecipeData(list.recipe_id);
                        list.recipe_name = recipeData?.strMeal || "Unknown Recipe";
                        list.recipe_image = recipeData?.strMealThumb || null;
                    }
                }

                savedShoppingLists = lists;
            } else {
                console.error("Failed to fetch shopping lists:", await response.json());
            }
        } catch (error) {
            console.error("Error fetching shopping lists:", error);
        } finally {
            isLoading = false;
        }
    }

    async function fetchRecipeData(recipeId) {
        if (!recipeId) {
            console.error('Invalid recipeId:', recipeId);
            return null;
        }

        try {
            const response = await fetch(`http://localhost:4053/proxy/mealdb?ingredient=${recipeId}`);
            if (response.ok) {
                const data = await response.json();
                return data?.meals?.[0] || null;
            } else {
                console.error('Failed to fetch recipe details:', response.statusText);
            }
        } catch (error) {
            console.error('Error fetching recipe details:', error);
        }
        return null;
    }

    function handleSelectList(list) {
        selectedList = list;
    }

    function closeSelectedList() {
        selectedList = null;
    }

    async function removeShoppingList(listId) {
        try {
            const response = await fetch(`http://localhost:4053/shopping-lists/${listId}`, {
                method: 'DELETE',
            });
            if (response.ok) {
                savedShoppingLists = savedShoppingLists.filter(list => list.id !== listId);
                if (selectedList && selectedList.id === listId) {
                    selectedList = null;
                }
                alert('Shopping list removed successfully!');
            } else {
                console.error('Failed to remove shopping list:', await response.json());
            }
        } catch (error) {
            console.error('Error removing shopping list:', error);
        }
    }
</script>

<div class="container mx-auto mt-6 p-6">
    <h1 class="text-3xl font-bold mb-6">Your Saved Shopping Lists</h1>

    {#if isLoading}
        <p>Loading your shopping lists...</p>
    {:else if savedShoppingLists.length > 0}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            {#each savedShoppingLists as list}
                <div class="shopping-list-card border p-4 rounded-lg text-center shadow hover:shadow-lg transition-all {selectedList === list ? 'selected' : ''}">
                    <img
                        src={list.recipe_image}
                        alt={list.recipe_name}
                        class="w-full h-32 object-cover rounded-md mb-2 cursor-pointer"
                        on:click={() => handleSelectList(list)}
                    />
                    <p class="font-semibold text-lg">{list.recipe_name || `Shopping List ${list.id}`}</p>
                </div>
            {/each}
        </div>

        {#if selectedList}
            <div class="mt-4 p-4 bg-white shadow-lg rounded-md">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold">{selectedList.recipe_name || `Shopping List ${selectedList.id}`}</h3>
                    <button
                        class="text-red-500 font-bold"
                        on:click={closeSelectedList}
                    >
                        Close
                    </button>
                </div>
                <ul class="list-none mt-2 text-center">
                    {#each selectedList.items as ingredient}
                        <li class="text-gray-700">
                            {ingredient.name}
                        </li>
                    {/each}
                </ul>
                <button
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mt-4"
                    on:click={() => removeShoppingList(selectedList.id)}
                >
                    Remove
                </button>
            </div>
        {/if}
    {:else}
        <p>No saved shopping lists yet.</p>
    {/if}
</div>

<style>
    .container {
        max-width: 1200px;
    }

    .shopping-list-card {
        border: 1px solid #ddd;
        padding: 1rem;
        border-radius: 8px;
        text-align: center;
    }

    .shopping-list-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    .shopping-list-card p {
        margin-top: 1rem;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .shopping-list-card.selected {
        border-color: #48bb78;
        background-color: #f0fff4;
    }

    .cursor-pointer:hover {
        background-color: #f7fafc;
    }

    .text-red-500 {
        color: red;
    }

    .text-blue-500 {
        color: blue;
    }

    .bg-white {
        background-color: #fff;
    }

    .shadow-lg {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .rounded-md {
        border-radius: 0.375rem;
    }

    .text-center {
        text-align: center;
    }

    .p-4 {
        padding: 1rem;
    }

    .mt-4 {
        margin-top: 1rem;
    }

    .text-xl {
        font-size: 1.25rem;
    }

    .font-semibold {
        font-weight: 600;
    }

    .group-hover\:opacity-100 {
        transition: opacity 0.3s;
    }

    .border {
        border: 1px solid #ddd;
    }

    .rounded {
        border-radius: 0.375rem;
    }

    .p-1 {
        padding: 0.25rem;
    }

    .mr-2 {
        margin-right: 0.5rem;
    }

    .mt-4 {
        margin-top: 1rem;
    }

    .bg-green-500 {
        background-color: #48bb78;
    }

    .text-white {
        color: #fff;
    }

    .py-2 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
</style>
