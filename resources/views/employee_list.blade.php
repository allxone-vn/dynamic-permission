@extends('admin')

<link rel="stylesheet" href="{{ asset('css/emp_list.css') }}">

@section('content')
    <h2>EMPLOYEE LIST</h2>
    <a href="{{ route('admin.addEmployeeForm') }}" class="button-link">Add employee</a>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone Number</th>              
                <th>Marital Status</th>
                <th>Salary</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employee as $employees)
                <tr>
                    <td>{{ $employees->username }}</td> 
                    <td>{{ $employees->full_name }}</td>              
                    <td>{{ $employees->date_of_birth }}</td>
                    <td>{{ $employees->gender }}</td>
                    <td>{{ $employees->address }}</td>
                    <td>{{ $employees->email }}</td>
                    <td>{{ $employees->phone_number }}</td>                  
                    <td>{{ $employees->marital_status }}</td>
                    <td>{{ $employees->salary }}</td>
                    <td>{{ $employees->created_at }}</td>
                    <td>{{ $employees->updated_at }}</td>                   
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
