<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'marital_status' => 'required|string|max:20',
            'salary' => 'required|numeric',
        ]);

        $profile = UserProfile::find($id);
        if ($profile) {
            $profile->full_name = $request->input('full_name');
            $profile->date_of_birth = $request->input('date_of_birth');
            $profile->gender = $request->input('gender');
            $profile->address = $request->input('address');
            $profile->phone_number = $request->input('phone_number');
            $profile->marital_status = $request->input('marital_status');
            $profile->salary = $request->input('salary');
            $profile->save();

            return redirect()->back()->with('success', 'Profile updated successfully.');
        }

        return redirect()->back()->with('error', 'Profile not found.');
    }
}
