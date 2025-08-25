<x-main-nav-bg>
    <div class="columns">
        <div class="column"></div>
        <div class="column">
            <form action="{{ route('notes.destroy', $note) }}" method="POST">
            @csrf
            @method('DELETE')
                <div class="card mt-1 mb-5">
                    <div class="card-content">
                        <h1 class="has-text-centered title is-3">Delete or Cancel</h1>
                    </div>
                    <div class="field is-grouped is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                        <div class="control mb-5">
                            <button class="button is-link">Delete</button>
                            <button class="button is-gray is-light">
                                <a class="has-text-grey-dark" href="{{route('notes.create',$note)}}">Cancel</a>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="column"></div>
    </div>
</x-main-nav-bg>
