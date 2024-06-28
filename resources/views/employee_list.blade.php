@extends('admin')

<link rel="stylesheet" href="{{ asset('css/emp_list.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

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
                @if(isset($permissions['full_name']) && $permissions['full_name'][1] == '1')
                    <th>Full Name</th>
                @endif
                @if(isset($permissions['date_of_birth']) && $permissions['date_of_birth'][1] == '1')
                    <th>Date of Birth</th>
                @endif
                @if(isset($permissions['gender']) && $permissions['gender'][1] == '1')
                    <th>Gender</th>
                @endif
                @if(isset($permissions['address']) && $permissions['address'][1] == '1')
                    <th>Address</th>
                @endif
                @if(isset($permissions['email']) && $permissions['email'][1] == '1')
                    <th>Email</th>
                @endif
                @if(isset($permissions['phone_number']) && $permissions['phone_number'][1] == '1')
                    <th>Phone Number</th>
                @endif
                @if(isset($permissions['marital_status']) && $permissions['marital_status'][1] == '1')
                    <th>Marital Status</th>
                @endif
                @if(isset($permissions['salary']) && $permissions['salary'][1] == '1')
                    <th>Salary</th>
                @endif
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employee as $employees)
                <tr>
                    <td>
                        <a href="{{ route('admin.editEmployee', ['id' => $employees->user_id]) }}" class="action"><i class="fas fa-user-edit"></i></a>
                        <a href="{{ route('admin.deleteUser', ['id' => $employees->user_id]) }}" class="action"><i class="fas fa-trash"></i></a>
                    </td>
                    <td>{{ $employees->username }}</td>
                    @if(isset($permissions['full_name']) && $permissions['full_name'][1] == '1')
                        <td>{{ $employees->full_name }}</td>
                    @endif
                    @if(isset($permissions['date_of_birth']) && $permissions['date_of_birth'][1] == '1')
                        <td>{{ $employees->date_of_birth }}</td>
                    @endif
                    @if(isset($permissions['gender']) && $permissions['gender'][1] == '1')
                        <td>{{ $employees->gender }}</td>
                    @endif
                    @if(isset($permissions['address']) && $permissions['address'][1] == '1')
                        <td>{{ $employees->address }}</td>
                    @endif
                    @if(isset($permissions['email']) && $permissions['email'][1] == '1')
                        <td>{{ $employees->email }}</td>
                    @endif
                    @if(isset($permissions['phone_number']) && $permissions['phone_number'][1] == '1')
                        <td>{{ $employees->phone_number }}</td>
                    @endif
                    @if(isset($permissions['marital_status']) && $permissions['marital_status'][1] == '1')
                        <td>{{ $employees->marital_status }}</td>
                    @endif
                    @if(isset($permissions['salary']) && $permissions['salary'][1] == '1')
                        <td>{{ $employees->salary }}</td>
                    @endif
                    <td>{{ $employees->created_at }}</td>
                    <td>{{ $employees->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
