<x-main-nav-bg>
    <div class="columns">
        <div class="column"></div>
        <div class="column">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="card mt-1 mb-5">
                    <div class="card-content">
                        <div>
                            <h1 class="has-text-centered title is-3">Login</h1>
                            <p class="has-text-centered help is-italic mb-5">Fields marked with a
                                <span class="has-text-danger">*</span>
                                are required to fill in.</p>
                        </div>
                        <!-- Email Address -->
                        <div class="field">
                            <label class="label">Email <span class="has-text-danger">*</span></label>
                            <div class="control">
                                <input id='email' class="input" type="email" name='email' value="{{old('email')}}" required autocomplete="username">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="help is-danger" />
                        </div>

                        <!-- Password -->
                        <div class="field">
                            <label class="label">Password <span class="has-text-danger">*</span></label>
                            <div class="control">
                                <input id='password' class="input" type="password" name='password' placeholder="e.g. A@a123456789" required autocomplete="current-password">
                            </div>
                            <p class="help">* We recommend using a password manager to generate and store secure passwords.</p>
                            <x-input-error :messages="$errors->get('password')" class="help is-danger" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="field is-grouped is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                            <div class="control">
                                @if (Route::has('password.request'))
                                    <button class="button is-gray is-light">
                                        <a class="has-text-grey-dark" href="{{ route('password.request') }}">Forgot your password?</a>
                                    </button>
                                @endif
                                <button class="button is-black" type="submit">
                                    <a class="has-text-light">Log in</a>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="column"></div>
    </div>
</x-main-nav-bg>
