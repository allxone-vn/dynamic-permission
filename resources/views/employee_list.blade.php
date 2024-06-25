@extends('admin')

<link rel="stylesheet" href="{{ asset('css/emp_list.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />
@section('content')
    <h2>EMPLOYEE LIST</h2>
    @if (session('success'))
    <div style="float: right" class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
        <div style="float: right" class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <a href="{{ route('admin.addEmployeeForm') }}" class="button-link">Add employee</a>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Action</th>
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
                    <td>
                        <a  href="" class="action"><i class="fas fa-user-edit"></i></a>
                        <a href="{{ route('admin.deleteUser', ['id' => $employees->user_id]) }}" class="action"><i class="fas fa-trash"></i></a>
                    </td>
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
