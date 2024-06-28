<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Profiles;
use App\Models\UserModel;

class LayoutEmploye extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'content' => view('page/dashboard') // Load view dashboard.php
        ];

        echo view('LayoutEmploye', $data);
    }
    public function changePassword()
    {
        $data = [
            'title' => 'Change Password',
            'content' => view('page/changepass') // Load view change_password.php
        ];

        echo view('LayoutEmploye', $data);
    }
    public function Permission()
    { $PermissionSelect = new PermissionSelect();
        $PermissionSelect->index();
    }
    
    
    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
