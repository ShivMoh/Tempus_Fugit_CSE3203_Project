@vite(['resources/css/login/stay_logged_in.css'])
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<body>
    <form id="stayLoggedInForm" method="POST" action="{{ route('stay-logged-in') }}">
        @csrf

        <h3>Welcome Back!</h3>

        <p>You are already logged in. Do you want to stay logged in or log out?</p>

        <button type="submit" name="action" value="stay">Stay Logged In</button>
        <button type="submit" name="action" value="logout">Log Out</button>
    </form>
</body>