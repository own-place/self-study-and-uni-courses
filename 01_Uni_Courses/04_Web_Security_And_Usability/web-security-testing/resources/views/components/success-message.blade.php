@if(session('success'))
    <meta http-equiv="refresh" content="2;url={{url()->current()}}">
    <div class="notification is-success">
        {{session('success')}}
    </div>
@endif
