<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('change_password');
    }

    public function showAccount(){
        return view('account');
    }

    public function changePassForm(){
        return view('change_pass_emp');
    }

    // Phương thức để xử lý thay đổi mật khẩu
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|different:current_password',
            'new_password_confirmation' => 'required|string|same:new_password',
        ]);
    
        $user = Auth::user();
    
        if (is_null($user)) {
            return back()->withErrors(['error' => 'User not found.'])->withInput();
        }
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }
    
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        if ($user->role_id == 1) {
            return redirect('/admin');
        } else {
            return redirect('/home');
        }
    }
    
    public function disconnectFacebook(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        // Giả sử bạn có một cột `facebook_id` trong bảng `users` để lưu trữ thông tin kết nối Facebook
        $user->facebook_id = null;
        $user->save();

        return redirect()->back()->with('success', 'Disconnected from Facebook successfully.');
    }
}
