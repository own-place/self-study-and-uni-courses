<x-main-nav-bg>
    <div class="container">
        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
            <img src="{{ asset('image/500.png') }}" alt="Error Image" style="width: 50%;">
            <p class="help has-text-grey">
                Picture designed by <a class="has-text-grey" href="http://www.freepik.com">stories / Freepik
            </p>
        </div>
        <div class="has-text-centered mt-5">
            <p class="title is-2">Hm...unfortunately,</p>
            <p class="title is-3">Something ain't right! Apologies.</p>
            <p class="subtitle is-5 mt-5 has-text-grey"><em>Would you like us to show you back <a class="has-text-grey" href="{{route('welcome')}}"><u>home</u></a>?</em></p>
        </div>
    </div>
</x-main-nav-bg>
