@vite(['resources/css/login/login_form.css'])
<link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<body>
    <form id="loginForm" method="POST" action="/login">
        @csrf

        <h3>Login</h3>

        <label for="email">Email</label>
        <input type="email" placeholder="example@site.com" id="email" name="email">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password">

        <button>Log In</button>
        <div class="register">
            <div class="register-link">
            Don't have an account? <a href="/register">Register</a>
            </div>
        </div>
    </form>
</body>