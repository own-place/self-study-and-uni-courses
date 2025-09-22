<script lang="ts">
  import { onMount } from 'svelte';
  import { goto } from '$app/navigation';
  import { authStore } from '../../lib/stores/authStore';
  import { writable } from 'svelte/store';
  import { page } from "$app/stores";

  let newUsername = '';
  let oldPassword = '';
  let newPassword = '';
  let errorMessage = '';
  let successMessage = '';
  let passwordErrorMessage = '';
  let passwordSuccessMessage = '';
  let token = '';
  let recipeCount = 0;
  let badges = [];
  let username = "";
  let savedShoppingLists = [];
  let user_id = null; // Initialize user_id
  let isLoading = true; // Loading state
  let selectedList = null; // Store the selected shopping list for display
  let isButtonDisabled = false; 
  let totalCo2Saved = 0;
  let totalMoneySaved = 0;
  let showCongrats = false;

  $: username = $authStore.user?.username || 'Guest';

  authStore.subscribe(($authStore) => {
    token = $authStore.token;
    recipeCount = $authStore.recipeCount || 0;
    user_id = $authStore.user?.id || null;
  });

  $: {
  badges = [];
  if (recipeCount >= 1) badges.push({ image: '/badges/badge_1.png', description: 'Completed 1 recipe' });
  if (recipeCount >= 5) badges.push({ image: '/badges/badge_2.png', description: 'Completed 5 recipes' });
  if (recipeCount >= 10) badges.push({ image: '/badges/badge_3.png', description: 'Completed 10 recipes' });
}

  onMount(() => {
    if (!token) {
      console.log('No token found, redirecting to login...');
      goto('/login');
    }
    fetchSavings();
  });

  onMount(() => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('congrats') === 'true') {
      showCongrats = true;
      setTimeout(() => {
        showCongrats = false;
      }, 5000); // Hide after 5 seconds
    }
  });

  async function updateUsername() {
    console.log('Sending token:', token);

    const response = await fetch('http://localhost:4001/api/users/update-username', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({ newUsername }),
    });

    const data = await response.json();

    if (response.ok) {
      successMessage = data.message;
      errorMessage = '';
      newUsername = '';

      authStore.update((state) => ({
        ...state,
        user: data.user,
      }));

      console.log('Username successfully updated and authStore updated.');
    } else {
      errorMessage = data.message;
      successMessage = '';
      console.log('Failed to update username:', data.message);
    }
  }

  async function changePassword() {
    console.log('Changing password with token:', token);

    const response = await fetch('http://localhost:4001/api/users/change-password', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
      },
      body: JSON.stringify({ oldPassword, newPassword }),
    });

    const data = await response.json();

    if (response.ok) {
      passwordSuccessMessage = data.message;
      passwordErrorMessage = '';
      oldPassword = '';
      newPassword = '';
      console.log('Password successfully changed.');
    } else {
      passwordErrorMessage = data.message;
      passwordSuccessMessage = '';
      console.log('Failed to change password:', data.message);
    }
  }

    // Fetch shopping lists when the component mounts
   onMount(() => {
    const user = JSON.parse(localStorage.getItem("user"));
    user_id = user?.id || null;
    if (!user_id) {
      console.error("User not logged in or no user_id found in localStorage");
      return;
    }
    console.log("Retrieved user_id:", user_id);
    fetchShoppingLists();
  });

  onMount(async () => {
    const fetchedSavings = await fetchSavings();
    console.log("Fetched savings:", fetchedSavings); // Log the fetched savings
    if (fetchedSavings && fetchedSavings.data) {
      totalCo2Saved = parseFloat(fetchedSavings.data.co2_saved) || 0;
      totalMoneySaved = parseFloat(fetchedSavings.data.money_saved) || 0;
      recipeCount = parseFloat(fetchedSavings.data.recipeCount) || 0;
      console.log("Current savings:", totalCo2Saved, totalMoneySaved);
    } else {
      console.error("Failed to fetch current savings");
    }
  });

  // Function to fetch shopping lists from the backend
  async function fetchShoppingLists() {
    if (!user_id) {
      console.error("user_id is not defined. Cannot fetch shopping lists.");
      return;
    }

    try {
      const response = await fetch(`http://localhost:4053/shopping-lists?userId=${user_id}`);
      if (response.ok) {
        const lists = await response.json();

        // For each shopping list, fetch recipe details if available
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
      isLoading = false; // Stop loading once the data is fetched
    }
  }

  // Function to fetch recipe details based on the recipeId
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

  // Handle click event to show details for the selected shopping list
  function handleSelectList(list) {
    selectedList = list; // Set the selected list for detailed view
  }

  // Close the selected list details
  function closeSelectedList() {
    selectedList = null;
  }

  const fetchSavings = async () => {
    try {
      const response = await fetch(
        `http://localhost:4000/api/users/${user_id}/savings`,
      );
      if (response.ok) {
        const data = await response.json();
        totalCo2Saved = data.co2_saved;
        totalMoneySaved = data.money_saved;
        return data;
      } else {
        console.error("Failed to fetch savings:", response.statusText);
        return null;
      }
    } catch (error) {
      console.error("Error fetching savings:", error);
      return null;
    }
  };
</script>

<div class="profile-page flex flex-col items-center bg-gray-100 py-8 px-4 sm:px-8">
  <header class="w-full max-w-5xl text-center mb-8">
    <h1 class="text-4xl font-bold text-green-600">Hello, <span class="italic">{username}!</span></h1>
  </header>

  <section class="w-full max-w-5xl flex flex-col sm:flex-row items-start">
    <div class="flex flex-col items-center bg-white shadow-lg rounded-lg p-6 sm:w-1/3 w-full">
      <img
        src="./profileicon.png"
        alt="Profile Avatar"
        class="w-32 h-32 rounded-full border-4 border-gray-300 mb-6"
      />

      <form on:submit|preventDefault={updateUsername} class="w-full space-y-4">
        <div>
          <label for="username" class="block text-lg font-medium text-gray-700 mb-2">Name:</label>
          <input
            type="text"
            id="username"
            bind:value={newUsername}
            placeholder="update your username"
            class="block w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-green-500 focus:border-green-500"
          />
        </div>
        <button
          type="submit"
          class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600 transition"
        >
          Save
        </button>
      </form>

      {#if errorMessage}
        <p class="text-red-500 mt-4">{errorMessage}</p>
      {/if}
      {#if successMessage}
        <p class="text-green-500 mt-4">{successMessage}</p>
      {/if}

      <div class="mt-8 w-full flex-1">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Change Password</h2>
        <form on:submit|preventDefault={changePassword} class="space-y-4">
          <div>
            <label for="oldPassword" class="block text-lg font-medium text-gray-700 mb-2">Old Password:</label>
            <input
              type="password"
              id="oldPassword"
              bind:value={oldPassword}
              class="block w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-green-500 focus:border-green-500"
            />
          </div>
          <div>
            <label for="newPassword" class="block text-lg font-medium text-gray-700 mb-2">New Password:</label>
            <input
              type="password"
              id="newPassword"
              bind:value={newPassword}
              class="block w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-green-500 focus:border-green-500"
            />
          </div>
          <button
            type="submit"
            class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition"
          >
            Update Password
          </button>
        </form>

        {#if passwordErrorMessage}
          <p class="text-red-500 mt-4">{passwordErrorMessage}</p>
        {/if}
        {#if passwordSuccessMessage}
          <p class="text-green-500 mt-4">{passwordSuccessMessage}</p>
        {/if}
      </div>
    </div>

    <div class="flex-grow mt-8 sm:mt-0 sm:ml-8 sm:w-2/3 w-full flex flex-col">
      <div class="bg-white shadow-lg rounded-lg p-6 text-center flex-2">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Your Savings</h2>
        <div class="badge-container mt-4 flex flex-wrap justify-center gap-4">
          <div class="bg-green-100 p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-green-800">Money Saved</h3>
            <p class="text-2xl font-bold text-green-600">{totalMoneySaved}€</p>
          </div>
          <div class="bg-blue-100 p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-blue-800">CO2 Reduced</h3>
            <p class="text-2xl font-bold text-blue-600">{totalCo2Saved}kg CO2e</p>
          </div>
        </div>
      </div>

      <div class="mt-8 bg-white shadow-lg rounded-lg p-6 text-center flex-3">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Achievements</h2>
        <div class="badge-container mt-4 flex flex-wrap justify-center gap-4">
          {#each badges as badge}
            <div class="relative group">
              <img src={badge.image} alt="Achievement Badge" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full shadow-md" />
              <div
                class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 px-3 py-1 rounded bg-gray-800 text-white text-sm opacity-0 group-hover:opacity-100 transition-opacity"
              >
                {badge.description}
              </div>
            </div>
          {/each}
        </div>
      </div>

      <!-- Leaderboards Section -->
      <div class="mt-8 bg-white shadow-lg rounded-lg p-6 text-center flex-3">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Leaderboards</h2>
        <div class="flex justify-center space-x-4">
          <button
            class="px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300"
            on:click={() => goto("/money-leaderboard")}
          >
            Money Saved Leaderboard
          </button>
          <button
            class="px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300"
            on:click={() => goto("/co2-leaderboard")}
          >
            CO2 Reduced Leaderboard
          </button>
        </div>
      </div>
    </div>
  </section>
</div>  

{#if showCongrats}
  <div
    class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50"
  >
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
      <h2 class="text-2xl font-bold text-green-600 mb-4">Congratulations</h2>
      <p class="text-gray-700 mb-4">Congratulations on completing a recipe!</p>
      <div class="flex justify-end">
        <button
          on:click={() => showCongrats = false}
          class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
        >
          Close
        </button>
      </div>
    </div>
  </div>
{/if}

<style>
  .cursor-pointer:hover {
    background-color: #f7fafc;
  }

  .text-red-500 {
    color: red;
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
</style>
