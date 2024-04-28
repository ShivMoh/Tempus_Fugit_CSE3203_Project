<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
@vite(['resources/js/app.js'])
<div>
        
    <h1 class="omega">Hello User!</h1>
    <h2>Lorem ipsum</h2>
</div>

<form method="POST" action=/login>
    @csrf
    <div>
        <label for ="email">Email</label>
        <input id="email" type="email" name="email" required autofocus>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required autofocus>
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
</form> 