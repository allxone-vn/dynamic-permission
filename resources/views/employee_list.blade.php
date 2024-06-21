@extends('admin')

@section('content')
    <h2>Employee List</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Date of Birth</th>
                <th>Marital Status</th>
                <th>Salary</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->user->name }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->phone_number }}</td>
                    <td>{{ $employee->date_of_birth }}</td>
                    <td>{{ $employee->marital_status }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>{{ $employee->department->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
