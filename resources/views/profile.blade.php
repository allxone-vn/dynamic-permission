@extends('admin')

@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card w-75">
            <div class="card-body">
                <h2 class="card-title text-center">User Profile</h2>
                <table class="table table-striped">
                    <tr>
                        <th>Full Name</th>
                        <td>{{ $profile->full_name }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ $profile->date_of_birth }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $profile->gender }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $profile->address }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{ $profile->phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Marital Status</th>
                        <td>{{ $profile->marital_status }}</td>
                    </tr>
                    <tr>
                        <th>Salary</th>
                        <td>{{ $profile->salary }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
