<?php

namespace App\Controllers;

use App\Models\Profiles;
use App\Models\UserModel;
use App\Models\DepmantModel; 

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

        $IDProfiles = $user['UserID'];

        // Instantiate the Profiles model
        $profileModel = new Profiles();

        // Find the profile by UserID
        $profile = $profileModel->where('IDProfiles', $IDProfiles)->first();
        if (!$profile) {
            // Handle the case when profile is not found
            return redirect()->to('/profile/not_found'); // Redirect to an appropriate page
        }

        $depmantModel = new DepmantModel();

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

        echo view('layout', $data);
    }
}
