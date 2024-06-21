<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <div class="container col-md-4" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('change.password') }}" method="POST">
                @csrf
                <h1>Change Password</h1>

                @if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <input type="password" class="form-control" placeholder="Current Password" name="current_password" required>
                <input class="mt-1" type="password" class="form-control" placeholder="New Password" name="new_password" required>
                <input class="mt-1" type="password" class="form-control" placeholder="Confirm New Password" name="new_password_confirmation" required>
                <button class="mt-2">Change Password</button>
            </form>
        </div>
    </div>

</body>
</html>
