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
<div class="auth-container">
  <h2>Register an Account</h2>

  <!-- Laravel error display -->
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="form-group">
      <input type="text" class="form-control" name="name" placeholder="Full Name"
             value="{{ old('name') }}" required autofocus autocomplete="name">
    </div>

    <!-- Email Address -->
    <div class="form-group">
      <input type="email" class="form-control" name="email" placeholder="Email"
             value="{{ old('email') }}" required autocomplete="username">
    </div>

    <!-- Password -->
    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password"
             required autocomplete="new-password">
    </div>

    <!-- Confirm Password -->
    <div class="form-group">
      <input type="password" class="form-control" name="password_confirmation"
             placeholder="Confirm Password" required autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary">Register</button>

    <a href="{{ route('login') }}" class="toggle-link">Already have an account? Login</a>
  </form>
</div>
</html>
