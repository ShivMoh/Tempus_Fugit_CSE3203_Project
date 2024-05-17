@vite(['resources/css/register/authorization_form.css'])
<link href="https://fonts.googleapis.com/css2?family=Outlaw&display=swap" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorization Page</title>
    <style>
        /* CSS code provided */
    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
    </div>
    <form method="POST" action="{{ route('authorization') }}">
        @csrf
        <h3>Authorization</h3>

        <label for="username">Username</label>
        <input type="email" placeholder="Username" id="username" name="email" required>
        @error('username')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Authorize</button>
    </form>
</body>