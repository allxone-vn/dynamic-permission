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
use App\Services\PermissionService;

class AdminController extends Controller
{

    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
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

    public function showSalaries()
    {
        $user = Auth::user();
        $permissions = $this->permissionService->getUserPermissions($user->role_id);

        // Lấy danh sách các bản ghi từ bảng salaries
        $salaries = DB::table('salaries')->get();

        return view('salary', compact('salaries','permissions'));
    }

    public function employeeList()
    {
        $user = Auth::user();
        $permissions = $this->permissionService->getUserPermissions($user->role_id);

        $employee = DB::table('users')
            ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->select('users.*', 'user_profiles.*')
            ->get();

        return view('employee_list', compact('employee', 'permissions'));
    }
    

    public function showAddEmployeeForm()
    {
        $roles = Role::all();
        return view('add-employee', compact('roles'));
    }

    // Hàm xử lý việc thêm nhân viên mới
    public function storeEmployee(Request $request)
    {
        $user = Auth::user();
        $permissions = $this->permissionService->getUserPermissions($user->role_id);

        $attributes = [
            'full_name' => 'Full Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date of Birth',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'marital_status' => 'Marital Status',
            'salary' => 'Salary',
        ];

        foreach ($attributes as $attribute => $name) {
            if (!isset($permissions[$attribute]) || $permissions[$attribute][0] != '1') {
                return redirect()->back()->with('error', "You do not have create permission for $name.");
            }
        }

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
    $user = Auth::user();
    $permissions = $this->permissionService->getUserPermissions($user->role_id);

    // Kiểm tra quyền xóa
    $canDelete = false;
    foreach ($permissions as $permission) {
        // Kiểm tra xem ký tự cuối cùng của giá trị nhị phân là '1' hay không
        if (substr($permission, -1) === '1') {
            $canDelete = true;
            break;
        }
    }

    if (!$canDelete) {
        return redirect()->back()->with('error', 'You do not have delete permission.');
    }

    // Tìm user để xóa
    $userToDelete = User::find($id);

    if (!$userToDelete) {
        return redirect()->back()->with('error', 'User not found.');
    }

    // Xóa user
    $deleted = $userToDelete->delete();

    if ($deleted) {
        return redirect()->back()->with('success', 'User has been deleted successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to delete user.');
    }
}


    public function editEmployee($id)
    {
            // Lấy thông tin user và hồ sơ người dùng
        $employee = User::findOrFail($id);
        $profile = UserProfile::where('user_id', $id)->firstOrFail();
        $roles = Role::all();

        return view('update_emp', compact('employee', 'profile', 'roles'));
    }

    public function updateEmployee(Request $request, $id)
{
    $employee = User::findOrFail($id);
    $profile = UserProfile::where('user_id', $id)->firstOrFail();

    // Kiểm tra tính hợp lệ của dữ liệu
    $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $employee->id,
        'email' => 'required|string|email|max:255|unique:users,email,' . $employee->id,
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

    // Cập nhật thông tin người dùng
    $employee->update([
        'username' => $request->username,
        'email' => $request->email,
        'role_id' => $request->role_name,
    ]);

    // Cập nhật hồ sơ người dùng
    $profile->update([
        'full_name' => $request->full_name,
        'gender' => $request->gender,
        'date_of_birth' => $request->date_of_birth,
        'address' => $request->address,
        'phone_number' => $request->phone_number,
        'marital_status' => $request->marital_status,
        'salary' => $request->salary,
    ]);

    // Chuyển hướng về trang danh sách nhân viên với thông báo thành công
    return redirect()->route('admin.employeeList')->with('success', 'Employee updated successfully.');
}
    
}
