@extends('admin')

@section('content')
<link rel="stylesheet" href="css/register.css">
<div class="container col-md-4" id="changepass">
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
@endsection
