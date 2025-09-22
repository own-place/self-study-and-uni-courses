<x-main-dashboard-user>
    <div class="p-4 sm:ml-64 flex mt-10 flex-wrap">
        <div class="w-full lg:gap-10 m-7">
            <div class="bg-white shadow-lg rounded-lg p-4 mx-auto lg:mx-0 flex items-center justify-between mb-4">
                <div class="text">
                    <h2 class="text-xl font-bold text-gray-900">{{__('Edit the comment:')}}</h2><br>
                    <form action="{{ route('comments.update', $comment) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <p><input class="input" type="text" name="comment" value="{{ __(old('comment', $comment)) }}" placeholder="{{__('Enter the comment here...')}}" autofocus></p><br>
                            @error('comment')
                            <span class="icon has-text-danger is-small is-right"><i class="fas fa-exclamation-triangle"></i></span>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{__('Save')}}
                            </button>
                            <a href="{{ route('comments.index') }}" type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                {{__('Cancel')}}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-main-dashboard-user>
