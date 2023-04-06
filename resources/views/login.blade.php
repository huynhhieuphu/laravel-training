@if(!empty(session('message')))
    <div>
        {{ session('message') }}
    </div>
@endif

<form action="/login" method="post">
    @csrf
    Username: <input type="text" name="username" value="{{ old('username') }}"> <br/>
    Password: <input type="password" name="password"> <br />
    <button type="submit">Login</button>
</form>
