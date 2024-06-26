<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <br><br>
            <div class="list-group list-group-flush">
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-light">Home</a>
                <a href="" class="list-group-item list-group-item-action bg-light">Edit Profile</a>
                <a href="" class="list-group-item list-group-item-action bg-light">Settings</a>
                <a href="{{ route('changePassword_form_emp') }}" class="list-group-item list-group-item-action bg-light">Change password</a>
                 <!-- Disconnect with Facebook Button -->
                 <form id="disconnect-facebook-form" action="{{ route('show.account') }}" method="get" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="list-group-item list-group-item-action bg-light" onclick="event.preventDefault(); document.getElementById('disconnect-facebook-form').submit();">Account</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="list-group-item list-group-item-action bg-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        @yield('content')   
</body>
</html>
