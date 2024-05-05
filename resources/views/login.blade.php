@vite(['resources/css/login/login_form.css'])

<div class="form-container">
<form method="POST" action=/login>
    @csrf
    
    <h1>Login</h1>
    
    <div>
        <label for ="email">Email</label>
        <input id="email" type="email" name="email" placeholder="user@example.com" required autofocus>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="password" required autofocus>
    </div>
    <div>
        <button type="submit">LOGIN</button>
    </div>
    <div class="register-link">
    Don't have an account? <a href="/register">Register</a>
</div>
</form> 
</div>

