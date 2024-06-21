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
    
        return redirect()->route('home')->with('success', 'Password changed successfully.');
    }
    
}
