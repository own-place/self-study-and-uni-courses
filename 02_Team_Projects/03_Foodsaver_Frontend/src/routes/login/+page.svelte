<script>
  import { onMount } from 'svelte';
  import { authStore, login } from '../../lib/stores/authStore';
  import { goto } from '$app/navigation';

  let username = '';
  let password = '';
  let errorMessage = '';
  let successMessage = '';
  let isLoggedIn = false;
  let showPassword = false;

  authStore.subscribe((state) => {
      isLoggedIn = state.isLoggedIn;
      console.log("Auth Store State: ", state);
  });

  onMount(() => {
      if (isLoggedIn) {
          console.log("User already logged in, redirecting to home...");
          goto('/');
      }
  });

  async function handleLogin() {
      const errorBox = document.getElementById('error-box');
      const successBox = document.getElementById('success-box');
      const errorText = document.getElementById('error-text');
      const successText = document.getElementById('success-text');

      if (errorBox && successBox && errorText && successText) {
          errorBox.classList.add('hidden');
          successBox.classList.add('hidden');
          errorText.textContent = '';
          successText.textContent = '';
      }

      if (!username || !password) {
          errorMessage = 'All fields are required!';
          if (errorBox && errorText) {
              errorText.textContent = errorMessage;
              errorBox.classList.remove('hidden');
          }
          return;
      }

      try {
          const API_BASE_URL = 'http://localhost:4001/api/users';

          console.log("Sending login request to backend...");
          const response = await fetch(`${API_BASE_URL}/login`, {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ username, password }),
          });

          const data = await response.json();
          console.log("Response from backend: ", data);

          if (data.success) {
          localStorage.setItem('authToken', data.token);
          login({ username: data.username, id: data.id }, data.token);
          console.log("Auth Store updated with user:", { username: data.username, id: data.id });

          successMessage = 'Login successful!';
          if (successBox && successText) {
              successText.textContent = successMessage;
              successBox.classList.remove('hidden');
          }

              setTimeout(() => {
                  goto('/');
              }, 2000);
          } else {
              errorMessage = data.message;
              if (errorBox && errorText) {
                  errorText.textContent = errorMessage;
                  errorBox.classList.remove('hidden');
              }
              console.log("Error during login: ", data.message);
          }
      } catch (error) {
          console.error("Error during login request: ", error);
          errorMessage = 'Something went wrong! Please try again later.';
          if (errorBox && errorText) {
              errorText.textContent = errorMessage;
              errorBox.classList.remove('hidden');
          }
      }
  }
</script>

<div id="error-box" class="hidden bg-red-100 text-red-700 border border-red-400 rounded-lg px-4 py-3 mb-4">
  <p id="error-text" class="text-sm font-medium"></p>
</div>

<div id="success-box" class="hidden bg-green-100 text-green-700 border border-green-400 rounded-lg px-4 py-3 mb-4">
  <p id="success-text" class="text-sm font-medium"></p>
</div>

<div class="LogIn max-w-lg mx-auto mt-10 bg-white rounded-xl relative">
  <img class="w-24 h-24 absolute top-[-40px] left-[1120px] rotate-12 opacity-50" src="../../../leaf-backgorund1.png" alt="Leaf Background" />
  <img class="w-24 h-24 absolute bottom-[-40px] right-[1120px] rotate-[-12deg] opacity-50" src="../../../leaf-background2.png" alt="Leaf Background" />

  <h1 class="text-4xl font-bold text-center text-black font-['Bree Serif'] mb-8">FoodSaver</h1>

  <div class="mb-4 text-center">
    <div class="inline-block px-10 py-2 bg-purple-50 text-black text-sm font-bold rounded-full shadow-sm">
      New to FoodSaver?
      <a href="/register" class="text-blue-700 font-bold hover:underline">Sign up</a>
    </div>
  </div>

  <div class="space-y-6">
    <div class="space-y-6">
      <div class="InputField">
        <label for="username" class="block text-gray-700 text-base font-medium">Username</label>
        <input
          type="text"
          id="username"
          bind:value={username}
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
        />
      </div>
      <div class="InputField">
        <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Password</label>
        <input
          type={showPassword ? "text" : "password"}
          id="password"
          bind:value={password}
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
        />
        <div class="flex items-center mt-2">
          <input
            type="checkbox"
            id="togglePassword"
            bind:checked={showPassword}
            class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-300"
          />
          <label for="togglePassword" class="text-sm text-gray-600 cursor-pointer">
            Show Password
          </label>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-8 space-y-4">
    <button 
      class="w-full py-3 bg-purple-200 text-purple-800 rounded-full text-sm font-medium hover:bg-purple-300"
      on:click={handleLogin}>
      Log in
    </button>
  </div>

  <div class="mt-8">
    <p class="text-center text-sm text-gray-600">Continue with...</p>
    <div class="flex justify-center space-x-4 mt-4">
      <img
        class="w-10 h-10 cursor-pointer rounded-full hover:opacity-80"
        src="../../../sprint-google.png"
        alt="Google"
      />
      <img
        class="w-10 h-10 cursor-pointer rounded-full hover:opacity-80"
        src="../../../sprint-facebook.png"
        alt="Facebook"
      />
      <img
        class="w-10 h-10 cursor-pointer rounded-full hover:opacity-80"
        src="../../../sprint-apple.png"
        alt="Apple"
      />
    </div>
  </div>

  <div class="mt-8 space-y-4">
    <button 
      class="w-full py-3 bg-purple-200 text-black font-bold rounded-full text-sm hover:bg-purple-300 mb-6">
      Continue as Guest
    </button>
    <div class="flex justify-between">
      <a href="#" class="text-blue-700 text-sm font-medium hover:underline">Forget your password?</a>
      <a href="#" class="text-blue-700 text-sm font-medium hover:underline">Problems logging in?</a>
    </div>
  </div>
</div>
