<script lang="ts">
  import { authStore } from "./../../../lib/stores/authStore.js";
  import { goto } from "$app/navigation";
  import {
    pantryStore,
    categoriesStore,
  } from "./../../../lib/stores/pantryStore"; // Import pantry store
  import { writable, derived, get } from "svelte/store";
  import { onMount, onDestroy } from "svelte";
  import {
    convertToGrams,
    convertToMilliliters,
  } from "../../../utils/conversion.js";
  import { page } from "$app/stores";
  import { tick } from "svelte";

  let user_id = 1;
  authStore.subscribe((state) => {
    user_id = state.user?.id || 1;
  });

  // Fetch recipe data from props
  export let data;
  const { recipe } = data.props;

  let isFavorite = false;
  let countdowns: Countdown[] = [];
  let showModal = false;
  let pantry = [];
  let categories = [];
  let showIngredientModal = writable<boolean>(false);
  let amountUsed = writable<number>(0);
  let measurementUnit = writable<string>("grams");
  let selectedIngredient = writable<string>("");
  let selectedIngredients: {
    [key: string]: { amount: number; measurement: string, category: string };
  } = {}; // Initialize selectedIngredients
  let warningMessage = writable<string>("");
  let editIngredient = writable<string>("");
  let editAmount = writable<number>(0);
  let editMeasurement = writable<string>("grams");
  let showEditModal = writable<boolean>(false);
  let missingIngredients = [];
  let showShoppingList = false;
  let isButtonDisabled = false;
  let totalCo2Saved = 0;
  let totalMoneySaved = 0;

  const measurementUnits = [
    "grams",
    "milliliters",
    "pieces",
    "tablespoons",
    "teaspoons",
    "cups",
    "pounds",
    "ounces",
  ];

  interface Countdown {
    time: number;
    interval: NodeJS.Timeout | null;
    input: number;
  }

  // Subscribe to the pantry store to get pantry data
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

  // Fetch pantry items from backend when component mounts
  onMount(async () => {
    fetchPantryItems();
    const fetchedSavings = await fetchSavings();
    console.log("Fetched savings:", fetchedSavings); // Log the fetched savings
    if (fetchedSavings && fetchedSavings.data) {
      totalCo2Saved = parseFloat(fetchedSavings.data.co2_saved) || 0;
      totalMoneySaved = parseFloat(fetchedSavings.data.money_saved) || 0;
      console.log("Current savings:", totalCo2Saved, totalMoneySaved);
    } else {
      console.error("Failed to fetch current savings");
    }
  });

  async function fetchPantryItems() {
    try {
      const response = await fetch(
        `http://localhost:4010/pantry?user_id=${user_id}`,
      );
      const data = await response.json();
      if (response.ok) {
        pantry = data.pantryItems;
        categories = data.categories;
        categoriesStore.set(categories);
        pantryStore.set(pantry);
      } else {
        console.error("Error fetching pantry items:", data.error);
      }
    } catch (error) {
      console.error("Error fetching pantry items:", error);
    }
  }

  const saveUsedAmount = (): void => {
    const selectedIngredientValue = $selectedIngredient; // Get the value of selectedIngredient
    const $filteredPantry = pantry; // Get the current value of filteredPantry
    const $filteredCategories = categories;
    const ingredientCategory = $filteredPantry.find(
      (item) => item.name === selectedIngredientValue,
    )?.category;
    selectedIngredients[selectedIngredientValue] = {
      amount: $amountUsed,
      measurement: $measurementUnit,
      category: ingredientCategory,
    };
    console.log("Filtered Categories:", $filteredCategories);
    // Close the form
    showIngredientModal.set(false);
  };

  const saveEditedAmount = (): void => {
    const ingredientName = $editIngredient;
    const $filteredPantry = pantry; // Get the current value of filteredPantry
    const ingredientCategory = $filteredPantry.find(
      (item) => item.name === ingredientName,
    )?.category;
    selectedIngredients[ingredientName] = {
      amount: $editAmount,
      measurement: $editMeasurement,
      category: ingredientCategory
    };

    // Close the form
    showEditModal.set(false);
  };

  const removeSelectedIngredient = (ingredientName: string): void => {
    delete selectedIngredients[ingredientName];
  };

  const updateIngredientsAndIncrementRecipeCount = async (): Promise<void> => {
    let invalidIngredients = []; // Array to collect invalid ingredient names
    const token = $authStore.token;

    try {
      const $filteredPantry = pantry; // Get the current value of filteredPantry
      const $filteredCategories = categories; // Get the current value of filteredCategories
      // Loop through selected ingredients and update quantities
      for (const [ingredientName, details] of Object.entries(
        selectedIngredients,
      )) {
        const ingredient = $filteredPantry.find(
          (item) => item.name === ingredientName,
        );
        const selectedCategory = details.category;  // Get the category of the selected ingredient
        const categoryDetails = $filteredCategories.find(
          (item) => item.category === selectedCategory,
        );
        console.log(`Category details for ${selectedCategory}:`, categoryDetails);
        if (!categoryDetails) {
          console.warn(`Category details not found for ${selectedCategory}`);
          invalidIngredients.push(ingredientName);
          continue;
        }

        const currentQuantity = ingredient?.quantity || 0;
        const currentMeasurement = ingredient?.measurement || "grams";
        let newQuantity = currentQuantity;

        // Convert the amount used to the same unit as the current quantity
        if (currentMeasurement === "grams") {
          if (
            [
              "grams",
              "kilograms",
              "tablespoons",
              "teaspoons",
              "cups",
              "pounds",
            ].includes(details.measurement)
          ) {
            newQuantity -= convertToGrams(details.amount, details.measurement);
          } else {
            invalidIngredients.push(ingredientName);
            continue;
          }
        } else if (currentMeasurement === "milliliters") {
          if (
            [
              "milliliters",
              "liters",
              "tablespoons",
              "teaspoons",
              "cups",
              "ounces",
            ].includes(details.measurement)
          ) {
            newQuantity -= convertToMilliliters(
              details.amount,
              details.measurement,
            );
          } else {
            invalidIngredients.push(ingredientName);
            continue;
          }
        } else if (currentMeasurement === "pieces") {
          if (details.measurement !== "pieces") {
            invalidIngredients.push(ingredientName);
            continue;
          }
          newQuantity -= details.amount;
        } 

        // Calculate CO2 and money saved
        const co2EmissionsPer1kg = categoryDetails?.co2_emissions_per_1kg;
        const costPer1kg = categoryDetails?.cost_per_1kg;
        const amountUsedInKg = details.amount / 1000; // Convert amount used to kg


        totalCo2Saved += co2EmissionsPer1kg * amountUsedInKg;
        totalMoneySaved += costPer1kg * amountUsedInKg;

        console.log(
          `Total CO2 Saved: ${totalCo2Saved}, Total Money Saved: ${totalMoneySaved}`,
        );

        // Remove or update the ingredient based on the new quantity
        if (newQuantity <= 0) {
          await removeIngredient(ingredientName);
        } else {
          const updateItem = {
            name: ingredientName,
            quantity: newQuantity,
            measurement: currentMeasurement,
            user_id: user_id, // Automatically associate the logged-in user
          };

          const response = await fetch(
            `http://localhost:4010/pantry/update/${encodeURIComponent(ingredientName)}?user_id=${user_id}`,
            {
              method: "PUT",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify(updateItem),
            },
          );

          const data = await response.json();

          if (response.ok) {
            console.log("Ingredient updated successfully:", data);
          } else {
            warningMessage.set(
              `Error updating ingredient: ${ingredientName}. ${data.error}`,
            );
          }
        }
      }

      if (invalidIngredients.length > 0) {
        console.warn("Invalid ingredients:", invalidIngredients.join(", "));
        warningMessage.set(`Invalid measurements for ingredients: ${invalidIngredients.join(", ")}`);
        return; // Do not update savings if there are invalid ingredients
      }

      // Increment the recipe count
      const response = await fetch(
        "http://localhost:4000/api/users/increment-recipe-count",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Authorization: `Bearer ${token}`,
          },
        },
      );

      if (!response.ok) {
        throw new Error("Failed to increment recipe count.");
      }

      const data = await response.json();
      authStore.update((state) => ({
        ...state,
        recipeCount: data.recipe_count,
      }));

      console.log("Recipe count incremented successfully.");

      // Update savings in the database
      await updateSavings(user_id, totalMoneySaved, totalCo2Saved);

      // Set cooldown on the button
      isButtonDisabled = true;
      setTimeout(() => {
        isButtonDisabled = false;
      }, 1800000);

      // Redirect to profile page with congratulations notification
      goto('/profile?congrats=true');
    } catch (error) {
      console.error(
        "Error updating ingredients or incrementing recipe count:",
        error,
      );
    }
  };

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

  const updateSavings = async (user_id, moneySaved, co2Saved) => {
    try {
      console.log("Updating savings with values:", {
        user_id,
        moneySaved,
        co2Saved,
      });

      const response = await fetch(
        `http://localhost:4000/api/users/${user_id}/update/savings`,
        {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            money_saved: moneySaved,
            co2_saved: co2Saved,
          }),
        },
      );

      if (!response.ok) {
        const errorText = await response.text();
        console.error("Error updating savings:", errorText);
        return;
      }

      const data = await response.json();
      console.log("Server response:", data);

      if (data.success) {
        console.log("Savings updated successfully!");
        await fetchSavings(); // Fetch the updated savings
      } else {
        console.error("Error updating savings:", data.message);
      }
    } catch (error) {
      console.error("Error updating savings:", error);
    }
  };

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
        warningMessage.set(`Error removing ingredient: ${name}. ${data.error}`);
      }
    } catch (error) {
    }
  };

  // Checking favorite status for recipe
  async function checkFavoriteStatus() {
    const response = await fetch(
      `http://localhost:3012/check-favorite/${recipe.id}?user_id=${user_id}`,
    );
    if (response.ok) {
      const data = await response.json();
      isFavorite = data.isFavorite;
    }
  }

  checkFavoriteStatus();

  // Toggle favorite status
  export async function toggleFavorite() {
    if (isFavorite) {
      const response = await fetch(
        `http://localhost:3012/favorites/${recipe.id}`,
        {
          method: "DELETE",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ user_id }),
        },
      );
      if (response.ok) {
        isFavorite = false;
      }
    } else {
      const response = await fetch("http://localhost:3012/favorites", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ recipe_id: recipe.id, user_id }),
      });
      if (response.ok) {
        isFavorite = true;
      }
    }
    checkFavoriteStatus();
  }

  function startCountdown(index: number, timeInSeconds: number) {
    if (timeInSeconds <= 0) return;

    if (!countdowns[index]) {
      countdowns[index] = {
        time: timeInSeconds,
        interval: null,
        input: timeInSeconds,
      };
    }

    if (countdowns[index]?.interval) {
      clearInterval(countdowns[index].interval);
    }

    countdowns[index].time = timeInSeconds;
    countdowns[index].interval = setInterval(() => {
      if (countdowns[index].time > 0) {
        countdowns[index].time -= 1;
        countdowns = [...countdowns];
      } else {
        clearInterval(countdowns[index].interval!);
        countdowns[index].interval = null;
        showTimeUpModal();
      }
    }, 1000);

    countdowns = [...countdowns];
  }

  function showTimeUpModal() {
    showModal = true;
  }

  function closeModal() {
    showModal = false;
  }

  // Function to split recipe instructions into individual steps
  function getSteps(instructions: string) {
    if (!instructions) return [];

    // Remove HTML tags from the instructions string
    instructions = instructions.replace(/<\/?[^>]+(>|$)/g, "");

    // Split by periods or newlines to create steps
    return instructions
      .split(/(?:\r?\n|\.\s*)/g)
      .filter((step) => step.trim().length > 0);
  }

  // Function to check if a step contains any time references
  function containsTime(step: string) {
    return /(\d+)(?:\s*min|\s*sec|\s*hour)/i.test(step);
  }

  function updateCountdownMinutes(index: number, minutes: string) {
    const value = parseInt(minutes, 10);
    if (!isNaN(value)) {
      countdowns[index] = {
        ...countdowns[index],
        minutes: value,
      };
    }
  }

  function updateCountdownSeconds(index: number, seconds: string) {
    const value = parseInt(seconds, 10);
    if (!isNaN(value)) {
      countdowns[index] = {
        ...countdowns[index],
        seconds: value,
      };
    }
  }

  function toggleShoppingList() {
    if (!showShoppingList) {
      findMissingIngredients();
    }
    showShoppingList = !showShoppingList;
  }

  function closeShoppingList() {
    showShoppingList = false;
  }

  function findMissingIngredients() {
    if (!recipe?.extendedIngredients || !Array.isArray(pantry)) return;

    missingIngredients = [];
    const recipeIngredients = recipe.extendedIngredients.map((ingredient) => ({
      name: ingredient.name || ingredient.original,
      requiredQuantity: ingredient.amount || 0,
    }));

    for (const recipeIngredient of recipeIngredients) {
      const pantryItem = pantry.find(
        (item) =>
          item.name.toLowerCase() === recipeIngredient.name.toLowerCase(),
      );

      if (
        !pantryItem ||
        pantryItem.quantity < recipeIngredient.requiredQuantity
      ) {
        const missingQuantity =
          recipeIngredient.requiredQuantity - (pantryItem?.quantity || 0);
        missingIngredients.push({
          name: recipeIngredient.name,
          requiredQuantity: missingQuantity,
        });
      }
    }
  }

  async function saveShoppingList() {
    console.log("Full Recipe Data:", recipe);

    if (!recipe || !recipe.title || !recipe.image) {
      console.error("Invalid recipe data:", recipe);
      alert("Recipe data is missing or incomplete.");
      return;
    }

    console.log("Saving shopping list with data:", {
      userId: user_id,
      shoppingListName: recipe.title, // Recipe name as shopping list name
      ingredients: missingIngredients, // Missing ingredients
      recipeTitle: recipe.title, // Recipe title
      recipeImage: recipe.image, // Recipe image URL
    });

    if (missingIngredients.length === 0) {
      alert("No missing ingredients to save!");
      return;
    }

    try {
      const shoppingListResponse = await fetch(
        "http://localhost:4053/shopping-lists",
        {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            userId: user_id,
            shoppingListName: recipe.title,
            ingredients: missingIngredients,
            recipeTitle: recipe.title,
            recipeImage: recipe.image,
          }),
        },
      );

      if (shoppingListResponse.ok) {
        alert("Shopping list saved successfully!");
      } else {
        const error = await shoppingListResponse.json();
        console.error("Failed to save shopping list:", error);
        alert("Failed to save shopping list.");
      }
    } catch (error) {
      console.error("Error saving shopping list:", error);
      alert("Error saving shopping list.");
    }
  }

  async function fetchShoppingLists() {
    try {
      const response = await fetch(
        `http://localhost:4053/shopping-lists?userId=${user_id}`,
      );
      if (response.ok) {
        const shoppingLists = await response.json();
        console.log("Fetched shopping lists:", shoppingLists);
        savedShoppingLists = shoppingLists;
      } else {
        console.error(
          "Failed to fetch shopping lists. Status:",
          response.status,
        );
      }
    } catch (error) {
      console.error("Error fetching shopping lists:", error.message);
    }
  }
</script>

{#if recipe}
  <div class="w-full mx-auto px-4">
    <section class="flex flex-col lg:flex-row mt-5">
      <div
        class="basis-full lg:basis-2/6 bg-gray-100 rounded-lg p-4 lg:p-10 lg:mr-8 mb-4 lg:mb-0"
      >
        <img
          class="rounded-lg mb-5 w-full"
          src={recipe.image}
          alt={recipe.title}
        />
        <h2 class="text-4xl mt-3 mb-3">Ingredients</h2>

        <div>
          <ul>
            {#each recipe.extendedIngredients as ingredient}
              <li>{ingredient.original}</li>
            {/each}
          </ul>
        </div>

        <!-- Button to add amount used and save shopping list -->
        <div class="flex justify-between mt-4">
          <button
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex-1 mr-2 text-center hidden lg:flex justify-center items-center"
            on:click={() => showIngredientModal.set(true)}
          >
            Add Amount Used
          </button>
          <button
            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 flex-1 ml-2"
            on:click={toggleShoppingList}
          >
            Show Shopping List
          </button>
        </div>
        <img
          src="./../../add-button.png"
          alt="Add Amount Used"
          class="w-20 h-20 fixed bottom-5 left-1/2 transform -translate-x-1/2 lg:hidden z-50 cursor-pointer"
          on:click={() => showIngredientModal.set(true)}
        />

        <!-- Display selected ingredient details -->
        {#each Object.entries(selectedIngredients) as [ingredientName, details]}
          <div class="bg-white p-4 rounded-lg shadow-md mb-4">
            <p class="text-lg font-semibold">Selected Ingredient:</p>
            <p>Name: {ingredientName}</p>
            <p>Amount Used: {details.amount} {details.measurement}</p>
            <button
              class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 mt-2"
              on:click={() => {
                editIngredient.set(ingredientName);
                editAmount.set(details.amount);
                editMeasurement.set(details.measurement);
                showEditModal.set(true);
              }}
            >
              Edit
            </button>
            <button
              class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 mt-2 ml-2"
              on:click={() => removeSelectedIngredient(ingredientName)}
            >
              Remove
            </button>
          </div>
        {/each}

        <!-- CO2 Calculation Button for desktop view -->
        <div
          class="recipe-card mt-3 p-4 bg-white border border-gray-300 rounded-lg text-center hidden lg:block"
        >
          <p class="text-lg font-semibold mb-4">
            If you finished this recipe, click below to calculate your CO2
            reduction.
          </p>
          <button
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full {isButtonDisabled ? 'disabled' : ''}"
            on:click={updateIngredientsAndIncrementRecipeCount}
            disabled={isButtonDisabled}
          >
            Complete
          </button>
        </div>
      </div>

      <!-- Recipe details and instructions -->
      <div class="basis-full lg:basis-4/5 bg-gray-100 rounded-lg p-4 lg:p-10">
        <h1 class="text-2xl lg:text-4xl mt-3 mb-3">
          {recipe.title}
          <img
            src={isFavorite ? "/solid-heart.png" : "/blank-heart.png"}
            alt="Favorite"
            class="inline-block w-6 h-6 cursor-pointer ml-3"
            on:click={toggleFavorite}
          />
        </h1>

        <div class="flex flex-wrap gap-2 mb-4">
          {#each recipe.dishTypes as type}
            <span
              class="bg-white border border-gray-300 text-black px-3 py-1 rounded-lg text-sm"
              >{type}</span
            >
          {/each}
        </div>

        <h2 class="text-2xl lg:text-4xl mt-3 mb-1">Instructions</h2>
        <p class="mb-1 text-gray-500 text-sm">
          (Don't forget to input the amount of ingredients used after every step
          so we can calculate how much CO2 and money you have saved.)
        </p>
        {#each getSteps(recipe.instructions) as step, index (step)}
          <div class="step flex flex-col lg:flex-row items-start gap-4 mb-4">
            <div class="flex items-left">
              <h3 class="text-lg lg:text-xl">Step {index + 1}</h3>
            </div>
            <div class="flex-2 text-left">
              <p class="mt-2">{step}.</p>

              {#if containsTime(step)}
                <div class="flex-3 items-left gap-2 mt-2 justify-end">
                  <span class="text-lg">⏰</span>
                  <input
                    type="number"
                    placeholder="Min"
                    min="0"
                    value={countdowns[index]?.minutes || ""}
                    on:input={(e) =>
                      updateCountdownMinutes(index, e.target.value)}
                    class="border border-gray-300 rounded px-2 w-20"
                  />
                  <span>:</span>
                  <input
                    type="number"
                    placeholder="Sec"
                    min="0"
                    max="59"
                    value={countdowns[index]?.seconds || ""}
                    on:input={(e) =>
                      updateCountdownSeconds(index, e.target.value)}
                    class="border border-gray-300 rounded px-2 w-20"
                  />
                  <button
                    on:click={() =>
                      startCountdown(
                        index,
                        Number(countdowns[index]?.minutes || 0) * 60 +
                          Number(countdowns[index]?.seconds || 0),
                      )}
                    class="bg-blue-500 text-white px-3 py-1 rounded"
                  >
                    Start
                  </button>
                  {#if countdowns[index] && countdowns[index].time !== null}
                    <p class="text-gray-700">
                      Time left: {Math.floor(countdowns[index].time / 60)}m
                      {countdowns[index].time % 60}s
                    </p>
                  {:else if countdowns[index]?.minutes || countdowns[index]?.seconds}
                    <p class="text-gray-700">
                      Time left: {countdowns[index].minutes || 0}m
                      {countdowns[index]?.seconds || 0}s
                    </p>
                  {:else}
                    <p class="text-gray-700">Time left: 0m 0s</p>
                  {/if}
                </div>
              {/if}
            </div>
            <div class="flex-1">
              {#if selectedIngredients[index]}
                <p class="mt-2 text-green-600">
                  Used: {selectedIngredients[index].name}, {selectedIngredients[
                    index
                  ].amount}
                  {selectedIngredients[index].measurement}
                </p>
              {/if}
            </div>
          </div>
        {/each}

        <!-- CO2 Calculation Button for phone view -->
        <div
          class="recipe-card mt-3 p-4 bg-white border border-gray-300 rounded-lg text-center lg:hidden"
        >
          <p class="text-lg font-semibold mb-4">
            If you finished this recipe, click below to calculate your CO2
            reduction.
          </p>
          <button
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full {isButtonDisabled ? 'disabled' : ''}"
            on:click={updateIngredientsAndIncrementRecipeCount}
            disabled={isButtonDisabled}
          >
            Complete
          </button>
        </div>
      </div>
    </section>
  </div>

  <!-- Modal for Time Up -->
  {#if showModal}
    <div
      class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50"
    >
      <div
        class="bg-white rounded-lg p-6 shadow-lg w-11/12 md:w-1/3 text-center"
      >
        <h2 class="text-2xl font-bold mb-4">Time to Go!</h2>
        <p>You've completed this step! Ready for the next?</p>
        <button
          class="bg-blue-500 text-white px-4 py-2 rounded mt-4"
          on:click={closeModal}
        >
          Close
        </button>
      </div>
    </div>
  {/if}

  <!-- Modal for Ingredient Selection -->
  {#if $showIngredientModal}
    <div
      class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 md:max-w-md">
        <h2 class="text-2xl font-bold text-green-600 mb-4">
          Select an Ingredient and an Amount Used
        </h2>
        <div class="mb-4">
          <select
            bind:value={$selectedIngredient}
            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
          >
            <option value="">Select an ingredient</option>
            {#each pantry as ingredient}
              <option value={ingredient.name}>{ingredient.name}</option>
            {/each}
          </select>
        </div>
        <div class="mb-4">
          <input
            type="number"
            bind:value={$amountUsed}
            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
          />Amount
        </div>
        <div class="mb-4">
          <select
            bind:value={$measurementUnit}
            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
          >
            {#each measurementUnits as unit}
              <option value={unit}>{unit}</option>
            {/each}
          </select>Measurement
        </div>
        <div class="flex justify-end space-x-4">
          <button
            on:click={() => showIngredientModal.set(false)}
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600"
          >
            Cancel
          </button>
          <button
            on:click={saveUsedAmount}
            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
          >
            Save
          </button>
        </div>
      </div>
    </div>
  {/if}

  <!-- Modal for Editing Ingredient Amount -->
  {#if $showEditModal}
    <div
      class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 md:max-w-md">
        <h2 class="text-2xl font-bold text-green-600 mb-4">
          Edit Ingredient
        </h2>
        <div class="mb-4">
          <input
            type="number"
            bind:value={$editAmount}
            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
          />Amount
        </div>
        <div class="mb-4">
          <select
            bind:value={$editMeasurement}
            class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:outline-none"
          >
            {#each measurementUnits as unit}
              <option value={unit}>{unit}</option>
            {/each}
          </select>Measurement
        </div>
        <div class="flex justify-end space-x-4">
          <button
            on:click={() => showEditModal.set(false)}
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600"
          >
            Cancel
          </button>
          <button
            on:click={saveEditedAmount}
            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
          >
            Save
          </button>
        </div>
      </div>
    </div>
  {/if}

  <!-- Warning Popup -->
  {#if $warningMessage}
    <div
      class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h2 class="text-2xl font-bold text-red-600 mb-4">Warning</h2>
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
{/if}

{#if showShoppingList}
  <div
    class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50"
  >
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 text-center">
      <h2 class="text-2xl font-bold mb-4">Shopping List</h2>
      {#if missingIngredients.length > 0}
        <ul>
          {#each missingIngredients as ingredient}
            <li>{ingredient.name}</li>
          {/each}
        </ul>
        <div class="mt-4 flex gap-4 justify-center">
          <button
            on:click={saveShoppingList}
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
          >
            Save Shopping List
          </button>
          <button
            on:click={closeShoppingList}
            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
          >
            Close
          </button>
        </div>
      {:else}
        <p>All ingredients are available in your pantry!</p>
        <div class="mt-4">
          <button
            on:click={closeShoppingList}
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
          >
            Close
          </button>
        </div>
      {/if}
    </div>
  </div>
{/if}

<style>
  /* Add your custom styles here */
  .step {
    margin-bottom: 1.5rem;
  }

  .disabled {
    background-color: gray !important;
    cursor: not-allowed;
  }
</style>