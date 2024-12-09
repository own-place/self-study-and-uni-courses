<x-main-nav-bg>
    <div class="columns">
        <div class="column"></div>
        <div class="column">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <div class="card mt-1 mb-5">
                    <div class="card-content">
                        <div>
                            <h1 class="has-text-centered title is-3">Reset Password</h1>
                            <p class="has-text-centered help is-italic mb-5">Fields marked with a
                                <span class="has-text-danger">*</span>
                                are required to fill in.</p>
                        </div>
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="field">
                            <label class="label">Email <span class="has-text-danger">*</span></label>
                            <div class="control">
                                <input id='email' class="input" type="email" name='email' value="{{old('email', $request->email)}}" required autocomplete="username">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="help is-danger" />
                        </div>

                        <!-- Password -->
                        <div class="field">
                            <label class="label">Password <span class="has-text-danger">*</span></label>
                            <div class="control">
                                <input id='password' class="input" type="password" name='password' placeholder="e.g. A@a123456789" required autocomplete="new-password">
                            </div>
                            <p class="help">* Password must be at least 12 characters long and contain at least one lowercase letter, one uppercase letter, one number, and one special character (e.g., @$!%*?&).</p>
                            <p class="help">* We recommend using a password manager to generate and store secure passwords.</p>
                            <x-input-error :messages="$errors->get('password')" class="help is-danger" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="field">
                            <label class="label">Confirm Password <span class="has-text-danger">*</span></label>
                            <div class="control">
                                <input id='password_confirmation' class="input" type="password" name='password_confirmation' required autocomplete="new-password">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="help is-danger" />
                        </div>

                        <div class="field is-grouped is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                            <div class="control">
                                <button class="button is-black" type="submit">
                                    <a class="has-text-light">Reset Password</a>
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
