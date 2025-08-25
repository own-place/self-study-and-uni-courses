<x-main-nav-bg>
    <div class="columns">
        <div class="column"></div>
        <div class="column">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="card mt-1 mb-5">
                    <div class="card-content">
                        <div>
                            <h1 class="has-text-centered title is-3">Forgot your password?</h1>
                            <p class="title is-4 has-text-centered">Let us know your email address!</p>
                            <p class="subtitle is-5 has-text-centered mt-4 mb-5">We will email you a password reset link that will allow you to choose a new one.</p>
                        </div>
                        <!-- Email Address -->
                        <div class="field">
                            <label class="label">Email <span class="has-text-danger">*</span></label>
                            <div class="control">
                                <input id='email' class="input" type="email" name='email' value="{{old('email')}}" required>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="help is-danger" />
                        </div>

                        <div class="field is-grouped is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                            <div class="control">
                                <button class="button is-black" type="submit">
                                    <a class="has-text-light">Email Password Reset Link</a>
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
