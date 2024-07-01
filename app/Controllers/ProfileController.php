<?php

namespace App\Controllers;

use App\Models\Profiles;
use App\Models\UserModel;
use App\Models\DepartmentModel; 

class ProfileController extends BaseController
{
    public function show()
    {
        // Start session
        $session = session();

        // Get the username from the session
        $username = $session->get('username');
        if (!$username) {
            // Handle the case when username is not found in session
            return redirect()->to('/login'); // Redirect to login or appropriate page
        }
        
        // Instantiate the Users model
        $userModel = new UserModel();
        
        // Find the user by username
        $user = $userModel->where('Username', $username)->first();
        
        if (!$user) {
            // Handle the case when user is not found
            return redirect()->to('/login'); // Redirect to login or appropriate page
        }

        $UserID = $user['UserID'];
        // Instantiate the Profiles model
        $profileModel = new Profiles();
        // Find the profile by UserID
        $profile = $profileModel->where('UserID', $UserID)->first();
        if (!$profile) {
            // Handle the case when profile is not found
            return redirect()->to('/profile/not_found'); // Redirect to an appropriate page
        }
        
        $depmantModel = new DepartmentModel();
        
        $IDProfiles = $profile['IDProfiles'];
        // Perform a join to fetch department details related to the profile
        $profileWithDepartment = $profileModel->join('Department', 'userprofiles.department_id = Department.id')
                                            ->where('userprofiles.IDProfiles', $IDProfiles)
                                            ->first();

        if (!$profileWithDepartment) {
            // Handle the case when profile with department details is not found
            return redirect()->to('/profile/not_found'); // Redirect to an appropriate page
        }

        // Pass the profile data with department details to the view
        $data = [
            'title' => 'Profile',
            'content' => view('page/profile', ['profile' => $profileWithDepartment])
        ];

        if ($username === 'admin') {
            echo view('layout', $data);
        } else {
            echo view('LayoutEmploye', $data);
        }
    }
    public function updateProfile()
    {
        // Get the request instance
        $request = \Config\Services::request();
        // Load the Profile model
        $profileModel = new Profiles();
        // Set validation rules
        $validationRules = [
            'full_name' => 'required',
            'birthdate' => 'required|valid_date',
            'gender' => 'required|alpha',
            'phone_number' => 'required|numeric',
            'address' => 'required',
            'marital_status' => 'required|alpha',
        ];
        if ($this->validate($validationRules)) {
            // Get input values
            $data = [
                'full_name' => $request->getPost('full_name'),
                'birthdate' => $request->getPost('birthdate'),
                'gender' => $request->getPost('gender'),
                'phone_number' => $request->getPost('phone_number'),
                'address' => $request->getPost('address'),
                'marital_status' => $request->getPost('marital_status'),
            ];
            // Assuming 'id' is passed as a hidden field in the form
            $session = session();

            $username = $session->get('username');
            if (!$username) {
                // Handle the case when username is not found in session
                return redirect()->to('/login'); // Redirect to login or appropriate page
            }
    
            // Instantiate the Users model
            $userModel = new UserModel();
            // Find the user by username
            $user = $userModel->where('Username', $username)->first();
            $UserID = $user['UserID'];
            $profileModel = new Profiles();
            // Find the profile by UserID
            $profile = $profileModel->where('UserID', $UserID)->first();
            $IDProfiles = $profile['IDProfiles'];
            if ($profileModel->update($IDProfiles, $data)) {
                return redirect()->to('/profile')->with('success', 'Profile updated successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update profile');
            }
        } else {
            // Validation failed
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }
}
