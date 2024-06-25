<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Support\Carbon;

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

    public function showAddEmployeeForm()
    {
        $roles = Role::all();
        return view('add-employee', compact('roles'));
    }

    // Hàm xử lý việc thêm nhân viên mới
    public function storeEmployee(Request $request)
    {
        // Kiểm tra tính hợp lệ của dữ liệu
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'date_of_birth' => [
                'required',
                'date',
                'before_or_equal:' . Carbon::now()->subYears(18)->format('Y-m-d')
            ],
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'marital_status' => 'required|string|max:10',
            'salary' => 'required|numeric',
            'role_name' => 'required|numeric|exists:roles,id',
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make('123'),
            'role_id' => $request->role_name,
        ]);

        // Tạo hồ sơ người dùng mới
        UserProfile::create([
            'user_id' => $user->id,
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'marital_status' => $request->marital_status,
            'salary' => $request->salary,
        ]);

        // Chuyển hướng về trang danh sách nhân viên với thông báo thành công
        return redirect()->route('admin.employeeList')->with('success', 'Employee added successfully.');
    }

public function deleteUser($id)
{
    // Tìm user để xóa
    $user = User::find($id);

    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    // Xóa user
    $deleted = $user->delete();

    if ($deleted) {
        return redirect()->back()->with('success', 'User has been deleted successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to delete user.');
    }
}
    
}
