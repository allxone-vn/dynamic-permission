<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <div class="container col-md-4" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h1>Create Account</h1>

                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
                    </div>
                </div>

                <input type="text" placeholder="UserName" name="username" required/>
                <input class="mt-1" type="email" placeholder="Email" name="email" required/>
                <input class="mt-1" type="password" placeholder="Password" name="password" required/>
                <input class="mt-1" type="password" placeholder="Confirm Password" name="password_confirmation" required/>
                <button class="mt-2">Register</button>
            </form>
        </div>
    </div>

</body>
</html>
