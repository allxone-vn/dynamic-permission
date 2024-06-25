<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class ChangePassword extends BaseController
{
    public function index()
    {
        return view('Home/changepass');
    }
    public function changePassword(){
        $session = session();

        // Get form data
        $currentPassword = $this->request->getPost('current-password');
        $newPassword = $this->request->getPost('new-password');
        $confirmNewPassword = $this->request->getPost('confirm-password');
        $currentPassword = esc($currentPassword);
        // // Validate inputs
        if (empty($currentPassword) || empty($newPassword) || empty($confirmNewPassword)) {
            $session->setFlashdata('error', 'All fields are required.');
            return redirect()->back();
        }

        if ($newPassword !== $confirmNewPassword) {
            $session->setFlashdata('error', 'New passwords do not match.');
            return redirect()->back();
        }
        

        // Get the logged-in user (adjust based on your auth system)
        $username = $session->get('username');
        $userModel = new UserModel();
        $user = $userModel->where('Username', $username)->first();
        // Check if the current password is correct
        if (!password_verify($currentPassword, $user['Pass'])) {
            $session->setFlashdata('error', 'Current password is incorrect.');
            return redirect()->back();
        }

        // Check if the new password is different from the current password
        if ($currentPassword === $newPassword) {
            $session->setFlashdata('error', 'New password must be different from the current password.');
            return redirect()->back();
        }

        // Update the password
        $userModel->update($username, ['Pass' => password_hash('$newPassword', PASSWORD_DEFAULT)]);

        $session->setFlashdata('success', 'Password changed successfully.');
        return redirect()->back();
    }
}
