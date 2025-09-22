<script>
  let username = '';
  let email = '';
  let password = '';
  let confirmPassword = '';
  let showPasswords = false;
  let errorMessage = '';
  let successMessage = '';

  function validateForm() {
    const errorBox = document.getElementById('error-box');
    const errorText = document.getElementById('error-text');

    if (!errorBox || !errorText) {
        console.error("Error box or error text element is missing in the DOM.");
        return false;
    }

    if (!username) {
        errorMessage = 'Username is required!';
        errorText.textContent = errorMessage;
        errorBox.classList.remove('hidden');
        return false;
    } else if (username.length < 3) {
        errorMessage = 'Username must be at least 3 characters long!';
        errorText.textContent = errorMessage;
        errorBox.classList.remove('hidden');
        return false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
        errorMessage = 'Email is required!';
        errorText.textContent = errorMessage;
        errorBox.classList.remove('hidden');
        return false;
    } else if (!emailRegex.test(email)) {
        errorMessage = 'Please enter a valid email address!';
        errorText.textContent = errorMessage;
        errorBox.classList.remove('hidden');
        return false;
    }

    const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (!password) {
        errorMessage = 'Password is required!';
        errorText.textContent = errorMessage;
        errorBox.classList.remove('hidden');
        return false;
    } else if (!passwordRegex.test(password)) {
        errorMessage = 'Password must be at least 8 characters long, include an uppercase letter, a number, and a special character!';
        errorText.textContent = errorMessage;
        errorBox.classList.remove('hidden');
        return false;
    }

    if (password !== confirmPassword) {
        errorMessage = "Passwords don't match!";
        errorText.textContent = errorMessage;
        errorBox.classList.remove('hidden');
        return false;
    }

    errorBox.classList.add('hidden');
    errorMessage = '';
    return true;
  }

  async function handleRegister() {
    console.log("Payload being sent:", { username, email, password });
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

    if (!validateForm()) {
        return;
    }

    try {
      const API_BASE_URL = 'http://localhost:4001/api/users';

        const response = await fetch(`${API_BASE_URL}/register`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, email, password }),
        });

        const data = await response.json();
        if (data.success) {
            successMessage = 'Registration successful! Redirecting to login...';
            if (successBox && successText) {
                successText.textContent = successMessage;
                successBox.classList.remove('hidden');
            }

            setTimeout(() => {
                window.location.href = '/login';
            }, 2000);
        } else {
            if (errorBox && errorText) {
                errorMessage = data.message;
                errorText.textContent = errorMessage;
                errorBox.classList.remove('hidden');
            }
        }
    } catch (error) {
        if (errorBox && errorText) {
            errorMessage = 'Something went wrong! Please try again later.';
            errorText.textContent = errorMessage;
            errorBox.classList.remove('hidden');
        }
    }
  }
</script>

<div class="Register max-w-lg mx-auto mt-10 bg-white rounded-xl relative p-8 shadow-lg">
  <img class="w-24 h-24 absolute top-[-40px] left-[1120px] rotate-12 opacity-50" src="../../../leaf-backgorund1.png" alt="Leaf Background" />
  <img class="w-24 h-24 absolute bottom-[-40px] right-[1120px] rotate-[-12deg] opacity-50" src="../../../leaf-background2.png" alt="Leaf Background" />

  <h1 class="text-4xl font-bold text-center text-black font-['Bree Serif'] mb-8">Create Account</h1>

  <div class="mb-4 text-center">
    <div class="inline-block px-10 py-2 bg-purple-50 text-black text-sm font-bold rounded-full shadow-sm">
      New to FoodSaver?
      <a href="/login" class="text-blue-700 font-bold hover:underline">Log in</a>
    </div>
  </div>

  <div id="error-box" class="hidden bg-red-100 text-red-700 border border-red-400 rounded-lg px-4 py-3 mb-4">
    <p id="error-text" class="text-sm font-medium"></p>
  </div>

  <div id="success-box" class="hidden bg-green-100 text-green-700 border border-green-400 rounded-lg px-4 py-3 mb-4">
    <p id="success-text" class="text-sm font-medium"></p>
  </div>

  <div class="space-y-6">
    <div class="InputField">
      <label for="username" class="block text-gray-700 text-base font-medium">Username</label>
      <input
        type="text"
        id="username"
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
        bind:value={username}
      />
    </div>
    <div class="InputField">
      <label for="email" class="block text-gray-700 text-base font-medium">Email</label>
      <input
        type="email"
        id="email"
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
        bind:value={email}
      />
    </div>
    <div class="InputField">
      <label for="password" class="block text-gray-700 text-base font-medium">Password</label>
      <input
        type={showPasswords ? "text" : "password"}
        id="password"
        placeholder="8 characters, uppercase letter, number, special character!"
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
        bind:value={password}
      />
    </div>
    <div class="InputField">
      <label for="confirm-password" class="block text-gray-700 text-base font-medium">Confirm Password</label>
      <input
        type={showPasswords ? "text" : "password"}
        id="confirm-password"
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
        bind:value={confirmPassword}
      />
    </div>
    <div class="flex items-center mt-2">
      <input
        type="checkbox"
        id="togglePasswords"
        bind:checked={showPasswords}
        class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-300"
      />
      <label for="togglePasswords" class="text-sm text-gray-600 cursor-pointer">Show Passwords</label>
    </div>
  </div>
  <div class="mt-8 space-y-4">
    <button 
      class="w-full py-3 bg-purple-200 text-purple-800 rounded-full text-sm font-medium hover:bg-purple-300"
      on:click={handleRegister}>
      Sign Up
    </button>
  </div>
</div>
  