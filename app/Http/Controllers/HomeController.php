<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
class HomeController extends Controller
{

    function index(){
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        // Lấy thông tin UserProfile của người dùng
        $profile = UserProfile::where('user_id', $user->id)->first();

        return view('home', compact('user', 'profile'));
    }

    public function employeeList()
    {
        $user = Auth::user();
        $userProfile = UserProfile::where('user_id', $user->id)->first();
        $profiles = UserProfile::with('user', 'department')->get();

        if ($userProfile && $userProfile->department_id == 1) {
            // Nhân viên phòng nhân sự xem được thông tin cá nhân của các nhân viên phòng ban khác trừ lương
            $profiles = $profiles->map(function ($profile) {
                $profile->salary = null;
                return $profile;
            });
        } elseif ($userProfile && $userProfile->department_id == 2) {
            // Nhân viên phòng kế toán xem được thông tin cá nhân của các nhân viên phòng ban khác trừ tình trạng hôn nhân
            $profiles = $profiles->map(function ($profile) {
                $profile->marital_status = null;
                return $profile;
            });
        } else {
            // Nhân viên các phòng ban khác chỉ có thể xem thông tin của mình
            $profiles = $profiles->where('user_id', $user->id)->values();
        }

        return view('view_emp_list', compact('profiles'));
    }

}
