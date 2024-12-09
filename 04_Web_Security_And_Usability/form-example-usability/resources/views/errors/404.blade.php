<x-main-nav-bg>
    <div class="container">
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                <img src="{{ asset('image/404.png') }}" alt="Error Image" style="width: 50%;">
        <p class="help has-text-grey">
            Picture designed by <a class="has-text-grey" href="http://www.freepik.com">stories / Freepik
        </p>
        </div>
        <div class="has-text-centered mt-5">
            <p class="title is-2">Oops! We can't find this page.</p>
            <p class="title is-3">Are you sure the website URL is correct?</p>
            <p class="subtitle is-5 mt-5 has-text-grey"><em>You can back <a class="has-text-grey" href="{{route('welcome')}}"><u>home</u></a> to try again.</em></p>
        </div>
    </div>
</x-main-nav-bg>
