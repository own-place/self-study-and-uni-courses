<!DOCTYPE html>
<html class="has-navbar-fixed-top">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ICT Dept</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
</head>
<body>
<nav class="navbar is-fixed-top is-white" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <p class="navbar-item">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAeZJREFUaEPtmG1uwzAIhunJtp1s68m2m21iKpVrY8xXjCLFf1q1NryPMZjkBicft5PrhwugOoJHRuALAD4B4AcA7o/PdN6jAEh8Kxgh8PfUcQQAJ55Ep0NkA0jiD4HIBNCIT4fIApiJxyODA5O5HynHKQNAEk9Jq5njSu4ogEWYZa4aJgLgEeRZI8J4ASJCImsHGA9AhoAMG/8wVoA0x49bOVydLACZ4ukohG1qAcKOhEwM2dYAhBwo66HbxwrAbVgpvJ3m8iUBuAw6hIcgZgBSY7aKWpABficG2N6JE/MOAN+CiioAlDRAcGJQPELMRiXAcHdxYmYhJKBKAHy+/mh3lhOD5/9NiEIlAIpHiOfQiOkjolkTSWSTP42YlUHMF+xpXkKrIMBIc28pVv5eTEcAqFJRwlseEfsy3a7dBsDdFcMZZSLBlekSANTGVSwpErM7pj0J2yKAAKu3EXTGKU+4+6UH3gogQSjyeLxZmaiKeRpJYk0TJkHMjtr2CJBIy5s5KdnLAFoQ/N7e5nR7al6zlwNozr405wLod8e0I9Htr6pCCbqfJkwb5imjmWJXtob+v1+gAbCUx5Ug6/8pALOexyrGM3/ZHGoigI6pl6HvHjGWNerWXAtgcb517gWwdbsZZ6ePwB+XM4YxW0d1TAAAAABJRU5ErkJggg=="/>
        </p>
        <p class="navbar-item">
            ｜
        </p>
        <p class="navbar-item">
            <a class="title is-5 {{ request()->routeIs('welcome') ? 'is-active' : '' }}" href="{{route('welcome')}}">
                Home
            </a>
        </p>
        <p class="navbar-item">
            ｜
        </p>
        <p class="navbar-item">
            @auth
                <a class="title is-5 {{ request()->routeIs('form') ? 'is-active' : '' }}" href="{{route('form')}}">
                    Form
                </a>
            @endauth
        </p>
        <p class="navbar-item">
            ｜
        </p>
        <p class="navbar-item">
            @auth
                <a class="title is-5 {{ request()->routeIs('notes.create') ? 'is-active' : '' }}" href="{{route('notes.create')}}">
                    Note
                </a>
            @endauth
        </p>
    </div>
    <div class="navbar-end">
        <div class="navbar-item">
            <div class="buttons">
                @guest()
                    <a href="{{ route('register') }}" class="button is-light">
                        <span class="is-size-5">Register</span>
                    </a>
                    <a href="{{ route('login') }}" class="button is-black">
                        <span class="is-size-5">Login</span>
                    </a>
                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link has-text-black is-size-4">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="navbar-dropdown">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="navbar-item is-size-5">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
<section class="hero is-light is-fullheight">
    <div>
        <div class="columns mt-2">
            <div class="column"></div>
            <div class="column">
                <x-success-message></x-success-message>
            </div>
            <div class="column"></div>
        </div>
        {{ $slot }}
    </div>
</section>
</body>
</html>
