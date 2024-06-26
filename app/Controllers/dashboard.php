<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'content' => view('page/dashboard') // Load view dashboard.php
        ];

        echo view('layout', $data);
    }

    public function changePassword()
    {
        $data = [
            'title' => 'Change Password',
            'content' => view('page/changepass') // Load view change_password.php
        ];

        echo view('layout', $data);
    }

    // Profile 
    public function profile()
    {
        // Load ProfileController to show the profile page
        $profileController = new ProfileController();
        $profileController->show();
    }    

    public function employee()
    {
        // Load ProfileController to show the profile page
        $EmployeeController = new EmployeeController();
        $EmployeeController->show();
    }    

    public function createEmployee()
    { 
        $CreateE = new CreateE();
        $CreateE->show();
    }
    
    public function Account()
    { 
        $Account = new Account();
        $Account->show();
    }


    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
