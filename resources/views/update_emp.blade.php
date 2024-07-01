@extends('admin')

<link rel="stylesheet" href="{{ asset('css/add_emp.css') }}">

@section('content')
<div class="header">
    <h1>UPDATE EMPLOYEE</h1>
</div>

<div class="content">
    <form action="{{ route('admin.updateEmployee', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ $employee->username }}" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $employee->email }}" required>
        </div>
        
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="{{ $profile->full_name }}" required>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <label for="male">
                <input class="gender" type="radio" id="male" name="gender" value="Male" {{ $profile->gender == 'Male' ? 'checked' : '' }} required> Male
            </label>
            <label for="female">
                <input class="gender" type="radio" id="female" name="gender" value="Female" {{ $profile->gender == 'Female' ? 'checked' : '' }} required> Female
            </label>
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ $profile->date_of_birth }}" required>
        </div>
        
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{ $profile->address }}" required>
        </div>
        
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ $profile->phone_number }}" required>
        </div>
        
        <div class="form-group">
            <label for="marital_status">Marital Status</label>
            <select id="marital_status" name="marital_status" required>
                <option value="Single" {{ $profile->marital_status == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Married" {{ $profile->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
                <option value="Divorced" {{ $profile->marital_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" id="salary" name="salary" value="{{ $profile->salary }}" required>
        </div>
        
        <div class="form-group">
            <label for="role_name">Role</label>
            <select id="role_name" name="role_name" required>
                @foreach ($roles as $role)
                    
                        <option value="{{ $role->id }}" {{ $employee->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
    
                @endforeach
            </select>
        </div>
        
        <button type="submit">Update Employee</button>
    </form>
</div>

<div class="footer">
    <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
</div>
@endsection
