<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">    
</head>
<body>

    <div class="container col-md-8" id="container">
        <div class="form-container sign-in-container">
            <form action="{{ Route('login') }}" method="POST">
				@csrf
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="{{ Route('auth.facebook') }}" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" placeholder="Email" name="email" />
                <input class="mt-1" type="password" placeholder="Password" name="password" />
                <a href="#">Forgot your password?</a>
                <button>Sign In</button>

                @if ($errors->any())
				<div class="alert alert-danger mt-2">
					@foreach ($errors->all() as $error)
						<p class="mb-0 mt-0">{{ $error }}</p>
					@endforeach
				</div>
				@endif

                @if (session('success'))
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
                @endif
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                {{-- <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div> --}}
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('signUp').addEventListener('click', function (event) {
            event.preventDefault();
            window.location.href = "{{ route('register_form') }}";
        });
    </script>
</body>
</html>