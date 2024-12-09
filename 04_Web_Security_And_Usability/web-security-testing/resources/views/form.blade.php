<x-main-nav-bg>
    <div class="columns">
        <div class="column"></div>
        <div class="column">
            <form action="{{route('student.store')}}" method="POST">
                @csrf
                <div class="card mt-1 mb-5">
                    <div class="card-content">
                        <div>
                            <h1 class="has-text-centered title is-3">Student Info</h1>
                            <p class="has-text-centered help is-italic mb-5">Fields marked with a
                                <span class="has-text-danger">*</span>
                                are required to fill in.</p>
                        </div>
                        <div class="field">
                            <label class="label">Name <span class="has-text-danger">*</span></label>
                            <div class="control">
                                <input class="input" type="text" name='name' value="{{old('name')}}" placeholder="e.g Alex Smith">
                            </div>
                            @error('name')
                            <p class="help is-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">Email <span class="has-text-danger">*</span></label>
                            <div class="control">
                                <input class="input" type="text" name='email' value="{{old('email')}}" placeholder="e.g. alexsmith@gmail.com">
                            </div>
                            @error('email')
                            <p class="help is-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">Phone <span class="has-text-danger">*</span></label>
                            <div class="field is-expanded">
                                <div class="field has-addons">
                                    <p class="control">
                                        <a class="button is-static">
                                            +31
                                        </a>
                                    </p>
                                    <p class="control is-expanded">
                                        <input class="input" type="text" name='phone' value="{{old('phone')}}" placeholder="123456789">
                                    </p>
                                </div>
                                <p class="help">* Do not enter the first zero</p>
                                @error('phone')
                                <p class="help is-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Gender <span class="has-text-danger">*</span></label>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select name="gender">
                                                <option value="-" {{ old('gender') == '-' ? 'selected' : '' }}> - </option>
                                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('gender'))
                                <p class="help is-danger">{{ $errors->first('gender') }}</p>
                            @endif
                        </div>
                        <div class="field">
                            <label class="label">Message</label>
                            <div class="control">
                                <textarea class="textarea has-fixed-size" name='message' value="{{old('message')}}" placeholder="e.g. what is the living cost in the NL?" rows="2"></textarea>
                            </div>
                            <p class="help">* Leave your questions of the ICT study programme.</p>
                        </div>
                        <div class="field is-grouped is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                            <div class="control">
                                <button class="button is-link">Submit</button>
                                <button class="button is-gray is-light">
                                    <a class="has-text-grey-dark" href="{{route('welcome')}}">Cancel</a>
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
