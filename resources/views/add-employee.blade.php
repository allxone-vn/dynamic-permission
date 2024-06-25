@extends('admin')

<link rel="stylesheet" href="{{ asset('css/add_emp.css') }}">

@section('content')
<div class="header">
    <h1>ADD EMPLOYEE</h1>
</div>

<div class="content">
    <form action="{{ Route('admin.storeEmployee') }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <label for="male">
                <input class="gender" type="radio" id="male" name="gender" value="Male" required> Male
            </label>
            <label for="female">
                <input class="gender" type="radio" id="female" name="gender" value="Female" required> Female
            </label>
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>
        </div>
        
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>
        </div>
        
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" required>
        </div>
        
        <div class="form-group">
            <label for="marital_status">Marital Status</label>
            <select id="marital_status" name="marital_status" required>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" id="salary" name="salary" required>
        </div>
        
        <div class="form-group">
            <label for="role_name">Role</label>
            <select id="role_name" name="role_name" required>
                @foreach ($roles as $role)
                    @if ($role->id != 1)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                 @endif
                @endforeach
            </select>
        </div>
        
        <button type="submit">Add Employee</button>
    </form>
</div>

<div class="footer">
    <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
</div>
@endsection
