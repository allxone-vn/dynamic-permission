<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function profile()
    {
         // Lấy thông tin người dùng hiện tại
         $user = Auth::user();
        
         // Lấy thông tin hồ sơ người dùng
         $profile = UserProfile::where('user_id', $user->id)->first();
 
         // Trả về view với thông tin người dùng và hồ sơ
         return view('profile', compact('user', 'profile'));
    }

    public function employeeList()
    {
        $employee = DB::table('users')
        ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
        ->select('users.*', 'user_profiles.*')
        ->get();

        // Trả về view với danh sách người dùng và hồ sơ
        return view('employee_list', compact('employee'));
    }

    // public function showAddEmployeeForm()
    // {
    //     $departments = Department::all();
    //     return view('add-employee', compact('departments'));
    // }

    public function storeEmployee(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        // $request->validate([
        //     'name' => 'required|string|max:255|unique:users,name',
        //     'email' => 'required|string|email|max:255|unique:users,email',
        //     'password' => 'required|string|min:8|confirmed',
        //     'full_name' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        //     'phone_number' => 'required|string|max:15',
        //     'date_of_birth' => 'required|date',
        //     'marital_status' => 'required|string',
        //     'salary' => 'required|numeric',
        //     'department_id' => 'required|exists:departments,id',
        // ]);

        // try {
        //     // Tạo người dùng mới
        //     $user = User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //     ]);

        //     // Tạo hồ sơ người dùng
        //     UserProfile::create([
        //         'user_id' => $user->id,
        //         'department_id' => $request->department_id,
        //         'full_name' => $request->full_name,
        //         'address' => $request->address,
        //         'phone_number' => $request->phone_number,
        //         'date_of_birth' => $request->date_of_birth,
        //         'marital_status' => $request->marital_status,
        //         'salary' => $request->salary,
        //     ]);

        //     return redirect()->route('admin.dashboard')->with('success', 'Employee added successfully.');
        // } catch (\Exception $e) {
        //     return redirect()->back()->withErrors(['error' => 'Failed to add employee.'])->withInput();
        // }


        $username = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $full_name = $request->input('full_name');
        $address = $request->input('address');
        $phone_number = $request->input('phone_number');
        $date_of_birth = $request->input('date_of_birth');
        $marital_status = $request->input('marital_status');
        $salary = $request->input('salary');
        $department_id = $request->input('department_id');

        // Tạo người dùng mới
        $user = User::create([
            'name' => $username,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        // Tạo hồ sơ người dùng
        UserProfile::create([
            'user_id' => $user->id,
            'department_id' => $department_id,
            'full_name' => $full_name,
            'address' => $address,
            'phone_number' => $phone_number,
            'date_of_birth' => $date_of_birth,
            'marital_status' => $marital_status,
            'salary' => $salary,
        ]);

        Role::create([ 
        'user_id' => $user->id,
        'name' => 'user',]        
        );

        return redirect()->route('admin.dashboard')->with('success', 'Employee added successfully.');
    }
}
