<?php

namespace App\Controllers;

use App\Models\Profiles;
use App\Models\UserModel;
use App\Models\DepartmentModel; // Corrected the namespace for DepartmentModel

class EmployeeController extends BaseController
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

        // Instantiate the Profiles model
        $profileModel = new Profiles();

        // Perform a join with DepartmentModel and UserModel to fetch department name and username
        $profiles = $profileModel->join('Department', 'userprofiles.department_id = Department.id')
                                ->join('User', 'userprofiles.UserID = User.UserID')
                                ->join('Role', 'User.role_id = Role.role_id')
                                ->select('userprofiles.*, Department.department_name, User.username,Role.role_name')
                                ->findAll(); // Assuming findAll() retrieves all records

        // Pass the profiles data to the view
        $data = [
            'title' => 'All Profiles',
            'content' => view('page/Employee', ['profiles' => $profiles])
        ];

        echo view('layout', $data); // Render the view with profiles data
    }
}

?>
