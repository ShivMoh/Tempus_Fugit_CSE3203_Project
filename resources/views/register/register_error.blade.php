@vite(['resources/css/register/register_error.css'])
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<head>
    <title>Error</title>
</head>
<body>
    <div class="container">
    <h1>{{ __('Error') }}</h1>
    
    @if (session('error'))
        <p> {{ session('error') }}</p>
    @endif

    <p>An error occurred. Please try again later.</p>
        <div class="button-container">
        <a href="/register" class="btn btn-primary">Go Back</a>
        </div>  
    </div>
</body>
