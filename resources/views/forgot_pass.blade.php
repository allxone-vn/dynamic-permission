<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/forgot.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="icon-lock">
                &#128274;
            </div>
            <h2>Forgot Password?</h2>
            <p>You can reset your password here.</p>
            <!-- Display success message -->
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <!-- Display validation errors -->
            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">
                        <i class="far fa-envelope"></i>
                    </label>
                    <input type="email" id="email" name="email" placeholder="Email address" required>
                </div>
                <button type="submit">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html>
