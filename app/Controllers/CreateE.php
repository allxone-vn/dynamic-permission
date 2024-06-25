<?php
namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\DepartmentModel;
use App\Models\UserModel;
use App\Models\Profiles;

class CreateE extends BaseController
{
    public function show()
    {
        // Instantiate the Role and Department models
        $roleModel = new RoleModel();
        $departmentModel = new DepartmentModel();

        // Fetch all roles and departments
        $roles = $roleModel->findAll();
        $departments = $departmentModel->findAll();

        // Pass the roles and departments data to the view
        $data = [
            'title' => 'Create Employee',
            'content' => view('page/createEmployee',  ['roles' => $roles,'departments' => $departments])
        ];

        echo view('layout', $data); // Render the view with roles and departments data
    }

    public function add()
    {
        // Get the form data
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'Username' => $this->request->getPost('Username'),
            'birthdate' => $this->request->getPost('birthdate'),
            'gender' => $this->request->getPost('gender'),
            'role_id' => $this->request->getPost('role'),
            'phone_number' => $this->request->getPost('phone_number'),
            'department_id' => $this->request->getPost('department_id'),
            'address' => $this->request->getPost('address'),
            'marital_status' => $this->request->getPost('marital_status'),
        ];

        // Validate the form data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'full_name' => 'required|max_length[100]',
            'Username' => 'required|max_length[100]',
            'birthdate' => 'required|valid_date',
            'gender' => 'required|max_length[10]',
            'role_id' => 'required|integer',
            'phone_number' => 'required|max_length[15]',
            'department_id' => 'required|integer',
            'address' => 'required|max_length[255]',
            'marital_status' => 'required|max_length[20]',
        ]);

        if ($validation->run($data) === FALSE) {
            // If validation fails, redirect back to the form with errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Start a transaction
        $db = \Config\Database::connect();
        $db->transStart();

        // Save the username and password to the users table
        $userModel = new UserModel();
        $userData = [
            'Username' => $data['Username'],
            'Pass' => password_hash('123', PASSWORD_DEFAULT),
            'role_id' => $data['role_id'],
        ];
        $userModel->insert($userData);
        // Get the inserted user's ID
        $user_id = $userModel->getInsertID();

        // Save the rest of the data to the user_profiles table
        $userProfileModel = new Profiles();
        $userProfileData = [
            'UserID' => $user_id,
            'full_name' => $data['full_name'],
            'birthdate' => $data['birthdate'],
            'gender' => $data['gender'],
            'phone_number' => $data['phone_number'],
            'department_id' => $data['department_id'],
            'address' => $data['address'],
            'marital_status' => $data['marital_status'],
            'start_date'=>date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $userProfileModel->insert($userProfileData);

        echo var_dump($userProfileData);
        // Complete the transaction
        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            // If transaction fails, redirect back with error
            return redirect()->back()->withInput()->with('error', 'Failed to create employee');
        }

        // If transaction succeeds, redirect to the home page with success message
        return redirect()->to('/Employee')->with('success', 'Employee created successfully');
    }
}

?>
