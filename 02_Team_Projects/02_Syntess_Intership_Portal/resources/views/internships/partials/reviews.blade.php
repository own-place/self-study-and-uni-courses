@php use Carbon\Carbon; @endphp
<div id="reviews" class="flex flex-row justify-evenly items-center px-8 flex-wrap gap-3 w-full">
    @foreach($reviews as $review)
        <article
            class="border-2 border-purple-500 border-solid py-5 flex justify-center items-center flex-col mb-5 w-1/4 shadow-2xl rounded-2xl">
            <div class="flex items-center mb-4">
                <img class="w-10 h-10 me-4 rounded-full object-contain"
                     src="{{ $review->pivot->anonymous ? 'https://www.refugee-action.org.uk/wp-content/uploads/2016/10/anonymous-user.png' : $review->pivot->user->photo }}"
                     alt="">
                <div class="font-medium dark:text-white">
                    <p>{{ $review->pivot->anonymous ? 'Anonymous' : $review->pivot->user->full_name }}</p>
                </div>
            </div>
            <div class="flex items-center justify-center mb-1 space-x-1 rtl:space-x-reverse">
                <svg class="w-4 h-4 {{$review->pivot->rating >= 1 ? 'text-yellow-300' : 'text-gray-300' }}"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 {{$review->pivot->rating >= 2 ? 'text-yellow-300' : 'text-gray-300' }}"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 {{$review->pivot->rating >= 3 ? 'text-yellow-300' : 'text-gray-300' }}"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 {{$review->pivot->rating >= 4 ? 'text-yellow-300' : 'text-gray-300' }}"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <svg class="w-4 h-4 {{$review->pivot->rating == 5 ? 'text-yellow-300' : 'text-gray-300' }}"
                     aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
            </div>
            <div class="mb-5 text-sm text-gray-500 dark:text-gray-400">
                <p>{{__('Reviewed on')}}
                    <time
                        datetime="{{$review->pivot->created_at}}">{{Carbon::parse($review->pivot->created_at)->format('F j, Y')}}</time>
                </p>
            </div>
            <p class="text-center mb-2 text-gray-500 dark:text-gray-400 w-full">{{ $review->pivot->review }}</p>
        </article>
    @endforeach
</div>
