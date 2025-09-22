<script>
  import { onMount } from "svelte";
  import { authStore } from "../lib/stores/authStore";
  import { goto } from "$app/navigation";
  import { page } from "$app/stores";
  import "../app.css";

  let isLoggedIn = false;
  let isLoginOrRegister = false;
  let isSpeaking = false;
  let utterance;

  authStore.subscribe((state) => {
    isLoggedIn = state.isLoggedIn;
  });

  $: {
    const currentPath = $page.url.pathname;
    isLoginOrRegister = currentPath === "/login" || currentPath === "/register";
  }

  onMount(() => {
    if (!isLoggedIn && !isLoginOrRegister) {
      goto("/login");
    }
  });

  const logout = () => {
    authStore.set({
      isLoggedIn: false,
      user: null,
    });
    localStorage.removeItem("isLoggedIn");
    localStorage.removeItem("user");
    goto("/login");
  };

  let isMenuOpen = false;
  const toggleMenu = () => {
    isMenuOpen = !isMenuOpen;
  };

  function readAloud() {
    if ("speechSynthesis" in window) {
      if (isSpeaking) {
        speechSynthesis.cancel();
        isSpeaking = false;
      } else {
        const text = document.body.innerText;
        utterance = new SpeechSynthesisUtterance(text);
        utterance.rate = 1; // Normal speed
        utterance.pitch = 1; // Normal pitch
        utterance.volume = 1; // Full volume

        utterance.onend = () => {
          isSpeaking = false;
        };

        isSpeaking = true;
        speechSynthesis.speak(utterance);
      }
    } else {
      alert("Sorry, your browser does not support speech synthesis!");
    }
  }
</script>

<!-- Conditional Navigation Bar -->
{#if !isLoginOrRegister}
  <nav
    class="w-full bg-white shadow-md p-4 px-10 flex justify-between items-center"
  >
    <div class="logo flex items-center space-x-2">
      <h1 class="text-2xl font-bold text-green-600 italic">FoodSaver</h1>
    </div>
    <div class="nav-links hidden md:flex space-x-6">
      <a href="/" class="text-gray-800 hover:text-green-500 text-lg">Home</a>
      <a href="/tips" class="text-gray-800 hover:text-green-500 text-lg"
        >Tips & Tricks</a
      >
      <a href="/pantry" class="text-gray-800 hover:text-green-500 text-lg"
        >My Pantry</a
      >
      <a href="/favorite" class="text-gray-800 hover:text-green-500 text-lg"
        >Favorite Recipes</a
      >
      <a href="/shoppinglists" class="text-gray-800 hover:text-green-500 text-lg"
        >Shopping Lists</a
      >
      <a href="/community" class="text-gray-800 hover:text-green-500 text-lg"
        >Community</a
      >
      <a href="/profile" class="text-gray-800 hover:text-green-500 text-lg"
        >Profile</a
      >
      <button
        on:click={logout}
        class="text-gray-800 hover:text-red-500 text-lg border border-gray-300 rounded px-3 py-0"
      >
        Logout
      </button>
    </div>
    <div class="md:hidden flex-1 flex justify-end">
      <button class="text-gray-800 focus:outline-none" on:click={toggleMenu}>
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16m-7 6h7"
          ></path>
        </svg>
      </button>
    </div>
  </nav>
{/if}

<!-- Mobile Navigation Menu -->
{#if isMenuOpen && !isLoginOrRegister}
  <div id="mobile-menu" class="md:hidden w-full bg-white shadow-md p-4 flex flex-col items-start">
    <a href="/" class="block text-gray-800 hover:text-green-500 text-lg mb-2">Home</a>
    <a href="/tips" class="block text-gray-800 hover:text-green-500 text-lg mb-2">Tips & Tricks</a>
    <a href="/pantry" class="block text-gray-800 hover:text-green-500 text-lg mb-2">My Pantry</a>
    <a href="/favorite" class="block text-gray-800 hover:text-green-500 text-lg mb-2">Favorite Recipes</a>
    <a href="/shoppinglists" class="block text-gray-800 hover:text-green-500 text-lg mb-2">Shopping Lists</a>
    <a href="/community" class="block text-gray-800 hover:text-green-500 text-lg mb-2">Community</a>
    <a href="/profile" class="block text-gray-800 hover:text-green-500 text-lg mb-2">Profile</a>
    <div class="w-full flex justify-end mt-2">
      <button
        on:click={logout}
        class="text-gray-800 hover:text-red-500 text-lg border border-gray-300 rounded px-3 py-1"
      >
        Logout
      </button>
    </div>
  </div>
{/if}

<button on:click={readAloud}>🔊 Read Aloud</button>

<div class="layout flex flex-col min-h-screen relative w-full">
  <img
    class="LeafBackgroundRemoved9 w-72 h-60 left-[-80.30px] top-[300px] absolute origin-top-left rotate-[0.0deg] rounded-xl -z-10"
    src="../../../leaf-background2.png"
    alt="Leaf Background"
  />

  <img
    class="LeafBackgroundRemoved9 w-72 h-60 right-[-50px] top-[230px] absolute origin-top-left rotate-[270deg] rounded-xl -z-10"
    src="../../../leaf-background1.png"
    alt="Leaf Background"
  />

  <main class="flex-1 p-4 w-full">
    <slot />
  </main>
  <!-- Footer -->
  <footer class="w-full bg-gray-100 shadow-inner py-8 text-center">
    <div
      class="footer-content container mx-auto px-6 md:flex md:justify-between md:items-center space-y-4 md:space-y-0"
    >
      <div class="footer-links text-left space-y-2">
        <h3 class="font-bold text-lg text-gray-800">Quick Links</h3>
        <ul class="space-y-1">
          <li>
            <a href="/privacy" class="text-gray-600 hover:text-green-500"
              >Privacy Policy</a
            >
          </li>
          <li>
            <a href="/terms" class="text-gray-600 hover:text-green-500"
              >Terms of Service</a
            >
          </li>
          <li>
            <a href="/contact" class="text-gray-600 hover:text-green-500"
              >Contact Us</a
            >
          </li>
          <li>
            <a href="/careers" class="text-gray-600 hover:text-green-500"
              >Careers</a
            >
          </li>
          <li>
            <a href="/blog" class="text-gray-600 hover:text-green-500"
              >Our Blog</a
            >
          </li>
        </ul>
      </div>
      <div class="footer-logo md:text-center">
        <img
        class="w-20 h-20 mx-auto"
        src="../../../foodsaver_logo.png"
        alt="Leaf Background"
      />
        <p class="text-gray-700 mt-2">
          Helping you make the most of your food, save money, and reduce waste.
          Let's make sustainability simple.
        </p>
      </div>
      <div class="footer-social text-left md:text-right space-y-2">
        <h3 class="font-bold text-lg text-gray-800">Follow Us</h3>
        <div class="social-icons flex space-x-4 justify-center md:justify-end">
          <a
            href="https://facebook.com"
            class="text-gray-600 hover:text-blue-600"
            target="_blank"
            rel="noopener noreferrer"
          >
            <i class="fab fa-facebook fa-2x"></i>
          </a>
          <a
            href="https://twitter.com"
            class="text-gray-600 hover:text-blue-400"
            target="_blank"
            rel="noopener noreferrer"
          >
            <i class="fab fa-twitter fa-2x"></i>
          </a>
          <a
            href="https://instagram.com"
            class="text-gray-600 hover:text-pink-500"
            target="_blank"
            rel="noopener noreferrer"
          >
            <i class="fab fa-instagram fa-2x"></i>
          </a>
          <a
            href="https://linkedin.com"
            class="text-gray-600 hover:text-blue-700"
            target="_blank"
            rel="noopener noreferrer"
          >
            <i class="fab fa-linkedin fa-2x"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="mt-6 border-t border-gray-300 pt-4">
      <p class="text-gray-600">© 2024 FoodSaver. All rights reserved.</p>
    </div>
  </footer>
</div>

<style>
  footer {
    background: #f9fafb;
    box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.05);
    font-family: "Arial", sans-serif;
  }

  .footer-links ul {
    list-style: none;
    padding: 0;
  }

  .footer-links li a {
    transition: color 0.3s ease;
  }

  .social-icons i {
    transition: color 0.3s ease;
  }

  .social-icons a {
    text-decoration: none;
  }

  .layout {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    width: 100%;
  }

  main {
    flex-grow: 1;
    width: 100%;
  }
</style>
