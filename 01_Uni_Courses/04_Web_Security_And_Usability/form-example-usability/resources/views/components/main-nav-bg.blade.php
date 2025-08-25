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
            <a class="title is-5 {{ request()->routeIs('form') ? 'is-active' : '' }}" href="{{route('form')}}">
                Form
            </a>
        </p>
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
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const currentLocation = window.location.pathname;
        const navItems = document.querySelectorAll('.navbar-item a');

        navItems.forEach(item => {
            if (item.getAttribute('href') === currentLocation) {
                item.classList.add('is-active');
            }
        });
    });
</script>
</body>
</html>
