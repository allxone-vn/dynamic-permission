<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use CodeIgniter\Email\Email;

class Login extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getVar('user');
        $password = $this->request->getVar('Pass');
        $user = $model->where('Username', $username)->first();
        if ($user) {
            $pass = $user['Pass'];
            if (password_verify($password, $pass)) {
                $session->set([
                    'UserID' => $user['UserID'],
                    'username' => $user['Username'],
                    'role_id' => $user['role_id'],
                    'logged_in' => TRUE
                ]);
                if ($user['role_id'] == 1) {
                    return redirect()->to('/layout');
                } else {
                    
                    return redirect()->to('/LayoutEmploye');
                }
            } else {
                return view('auth/login', ['error' => 'Invalid Username or Password']);
            }
        } else {
            return view('auth/login', ['error' => 'Invalid Username or Password']);
        }
    }
}
