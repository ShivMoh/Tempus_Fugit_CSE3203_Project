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

        @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <label for="username">Email</label>
        <input type="email" placeholder="Email" id="username" name="email" required>
        
        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>

        <button type="submit">Authorize</button>
    </form>
</body>