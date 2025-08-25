<x-main-nav-bg>
    <div class="columns">
        <div class="column"></div>
        <div class="column">
            <form action="{{ route('notes.update',$note) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card mt-1 mb-5">
                    <div class="card-content">
                        <div>
                            <h1 class="has-text-centered title is-3">Notes Board</h1>
                            <p class="has-text-centered help is-italic mb-5">Fields marked with a
                                <span class="has-text-danger">*</span>
                                are required to fill in.</p>
                        </div>
                        <div class="field">
                            <label class="label">Title <span class="has-text-danger">*</span></label>
                            <div class="control">
                                <input class="input" type="text" name='title' value="{{ old('title', $note) }}" placeholder="Type your title here">
                            </div>
                            @error('title')
                            <p class="help is-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">Content <span class="has-text-danger">*</span></label>
                            <div class="control">
                                <input class="input" type="text" name='content' value="{{ old('content', $note) }}" placeholder="Type your content here">
                            </div>
                            @error('content')
                            <p class="help is-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="field is-grouped is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                            <div class="control">
                                <button class="button is-link">Save</button>
                                <button class="button is-gray is-light">
                                    <a class="has-text-grey-dark" href="{{route('notes.create')}}">Cancel</a>
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
