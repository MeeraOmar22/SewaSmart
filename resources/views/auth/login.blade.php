<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login / Sign Up</title>
    
    <!-- Laravel Mix or Asset CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Add other CSS as needed -->

    <style>
      body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: 'Poppins', sans-serif;
      }
      .auth-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
      }
      .auth-container h2 {
        margin-bottom: 20px;
        text-align: center;
      }
      .form-group {
        margin-bottom: 15px;
      }
      .btn-primary {
        width: 100%;
      }
      .toggle-link {
        display: block;
        text-align: center;
        margin-top: 10px;
      }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2>Login</h2>

        <!-- Laravel session status message -->
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <!-- Laravel validation error messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Actual login form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                <label class="form-check-label" for="remember_me">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="{{ route('register') }}" class="toggle-link">Don't have an account? Sign Up</a>

            @if (Route::has('password.request'))
                <a class="toggle-link" href="{{ route('password.request') }}">Forgot your password?</a>
            @endif
        </form>
    </div>
</body>
</html>
