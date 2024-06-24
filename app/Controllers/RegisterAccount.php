<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class RegisterAccount extends BaseController
{
    public function register(){
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $pass = $this->request->getVar('password');
        $existingUser = $model->where('Username', $username)->first();

        if ($existingUser) {
            return redirect()->back()->withInput()->with('error', 'Username already exists. Please choose a different username.');
        }
            $data = [
            'Username' => $this->request->getPost('username'),
            'Pass' => password_hash( $pass, PASSWORD_DEFAULT),
            'role_id' => 4, // Set a default role id or retrieve it as needed
            'google_id' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($model->save($data)) {
            $data = [
                'username' => $username, 
                
            ];
            return view('Home', $data);   
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to create account.');
        }
        
    }
}
