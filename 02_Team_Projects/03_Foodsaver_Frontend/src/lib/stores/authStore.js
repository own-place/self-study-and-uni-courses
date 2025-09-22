import { writable } from 'svelte/store';

export const authStore = writable(
  {
    isLoggedIn: false,
    user: null,
    token: null,
    recipeCount: 0, // Add this for tracking the recipe count
  },
  
  (set) => {
    const savedLoginState = localStorage.getItem('isLoggedIn') === 'true';
    const savedUser = JSON.parse(localStorage.getItem('user'));
    const savedToken = localStorage.getItem('authToken');
    const savedRecipeCount = parseInt(localStorage.getItem('recipeCount')) || 0;

    if (savedLoginState && savedToken) {
      set({
        isLoggedIn: true,
        user: savedUser,
        token: savedToken,
        recipeCount: savedRecipeCount, // Initialize it
      });
    }

    return authStore.subscribe((state) => {
      localStorage.setItem('isLoggedIn', state.isLoggedIn);
      localStorage.setItem('user', JSON.stringify(state.user));
      localStorage.setItem('authToken', state.token || '');
      localStorage.setItem('recipeCount', state.recipeCount); // Save it
    });
  }
);

export function login(user, token) {
  authStore.set({
    isLoggedIn: true,
    user: user,
    token: token,
  });
};

export function logout() {
  authStore.set({
    isLoggedIn: false,
    user: null,
    token: null,
  });
  localStorage.removeItem('isLoggedIn');
  localStorage.removeItem('user');
  localStorage.removeItem('authToken');
  localStorage.removeItem('recipeCount'); // Clear this as well
};