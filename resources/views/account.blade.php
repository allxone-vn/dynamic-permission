<link rel="stylesheet" href="{{ asset('css/acount.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@extends('home')

@section('content')
    <div class="container mt-5">
        <h4>Service sign-in</h4>
        <p>Connect a service for sign-in.</p>
        <h4>Connected Accounts</h4>
        <p>Select a service to sign in with.</p>
        <div class="buttons">
            @if(Auth::user()->facebook_id)
            <form action="{{ route('facebook.disconnect') }}" method="POST">
                @csrf
                <button type="submit" class="facebook">
                    <i class="fa-brands fa-facebook"></i> Disconnect Facebook
                </button>
            </form>
        @else
            <form action="{{ route('auth.facebook') }}" method="GET">
                @csrf
                <button type="submit" class="facebook">
                    <i class="fa-brands fa-facebook"></i> Connect Facebook
                </button>
            </form>
        @endif
            <button class="github"><i class="fa-brands fa-github"></i> Connect GitHub</button>
        </div>

        <!-- Hiển thị thông báo -->
        @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
@endsection
