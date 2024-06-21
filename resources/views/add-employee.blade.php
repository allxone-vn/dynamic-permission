<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link rel="stylesheet" href="{{ asset('css/add_emp.css') }}">
</head>
<body>
    <div class="header">
        <h1>Add Employee</h1>
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

            <label for="username">Username:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
            
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>
            
            <label for="marital_status">Marital Status:</label>
            <select id="marital_status" name="marital_status" required>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
            </select>
            
            <label for="salary">Salary:</label>
            <input type="number" id="salary" name="salary" required>
            
            <label for="department_id">Department:</label>
            <select id="department_id" name="department_id" required>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            
            <button type="submit">Add Employee</button>
        </form>
    </div>

    <div class="footer">
        <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
    </div>
</body>
</html>
