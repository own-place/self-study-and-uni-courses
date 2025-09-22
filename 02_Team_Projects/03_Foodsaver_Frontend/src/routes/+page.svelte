<script>
  import RecipeSearch from "../components/RecipeSearch.svelte";
  import Pantry from "../components/Pantry.svelte";
  import { onMount } from "svelte";
  import { pantryStore } from "../lib/stores/pantryStore";
  import { authStore } from "../lib/stores/authStore";

  let user_id = 1;

  authStore.subscribe((state) => {
    user_id = state.user?.id || 1;
  });

  async function fetchPantryItems() {
    const response = await fetch(
      `http://localhost:4010/pantry?user_id=${user_id}`,
    );
    const data = await response.json();
    if (response.ok) {
      pantryStore.set(data);
    } else {
      console.error("Error fetching pantry items:", data.error);
    }
  }

  onMount(() => {
    fetchPantryItems();
  });
</script>

<div class="main-content mt-4 flex-1 flex">
  <RecipeSearch />
</div>

<style>
  .main-content {
    display: flex;
    flex-grow: 1;
  }
</style>
