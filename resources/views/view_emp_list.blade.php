<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <h2>Employee List</h2>
    <button class="back" onclick="goBack()">Back</button>
    <table border="1">
        <tr>
            <th>Full Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Date of Birth</th>
            <th>Marital Status</th>
            <th>Salary</th>
            <th>Department</th>
        </tr>
        @foreach ($profiles as $profile)
        <tr>
            <td>{{ $profile->full_name }}</td>
            <td>{{ $profile->address }}</td>
            <td>{{ $profile->phone_number }}</td>
            <td>{{ $profile->date_of_birth }}</td>
            <td>{{ $profile->marital_status }}</td>
            <td>{{ $profile->salary }}</td>
            <td>{{ $profile->department->name }}</td>
        </tr>
        @endforeach
    </table>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>
</html>
