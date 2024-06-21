<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
</head>
<link rel="stylesheet" href="css/admin.css">
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>  
    </div>
    <div class="sidebar">
        <h2>Navigation</h2>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="#">Users</a>
        <a href="#">Settings</a>
        <a href="#">Profile</a>
        <a href="{{ route('admin.addEmployeeForm') }}">Add Employee</a>
        <a href="{{ route('admin.employeeList') }}">Employee List</a>
        <div class="logout-button">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        <p>Admin Dashboard - All rights reserved</p>
    </div>
</body>
</html>
