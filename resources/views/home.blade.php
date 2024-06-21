<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<link rel="stylesheet" href="css/home.css">
<body>
    <div class="logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    
    <h1>Welcome, {{ $user->name }}</h1>

    @if ($profile)
    <h2>User Profile</h2>
    <table border="1">
        <tr>
            <th>Full Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Marital Status</th>
            <th>Salary</th>
        </tr>
        <tr>
            <td>{{ $profile->full_name }}</td>
            <td>{{ $profile->date_of_birth }}</td>
            <td>{{ $profile->gender }}</td>
            <td>{{ $profile->address }}</td>
            <td>{{ $profile->phone_number }}</td>        
            <td>{{ $profile->marital_status }}</td>
            <td>{{ $profile->salary }}</td>

            {{-- department đã được định nghĩa bên model UserProfile --}}
        </tr>
    </table>
    @else
    <p>No profile information available.</p>
    @endif

    {{-- @if ($profile && in_array($profile->department->name, ['Human Resources', 'Finance']))
        <div class="employee-list">
            <a href="{{ route('employee.list') }}">View Employee List</a>
        </div>
    @endif --}}

    <form action="{{ route('changePassword_form') }}" method="get">
        @csrf
        <button type="submit">Change Password</button>
    </form>

</body>
</html>
