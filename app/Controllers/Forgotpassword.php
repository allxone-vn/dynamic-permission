<?php

namespace App\Controllers;
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use Config\Services;

class Forgotpassword extends Controller
{
    public function index()
    {
        return view('auth/forgotpass');
    }

    public function process()
    {
        // Lấy email từ form POST
        $userEmail = $this->request->getPost('email');

        // Tạo mật khẩu ngẫu nhiên
        $newPassword = $this->generateRandomPassword();

        // Cập nhật mật khẩu mới vào database
        $userModel = new UserModel();
        $user = $userModel->findByEmail($userEmail);
        echo var_dump($user);
        if ($user) {
           
            $userModel->updatePasswordByEmail($userEmail, password_hash($newPassword, PASSWORD_DEFAULT));
            // Gửi email chứa mật khẩu mới
            $this->sendNewPasswordEmail($userEmail, $newPassword);

            // Set flashdata for success message
            $session = session();
            $session->setFlashdata('success', 'A new password has been sent to your email.');
        } else {
            // Set flashdata for error message
            $session = session();
            $session->setFlashdata('error', 'Email address not found.');
        }

        // Redirect back to forgot password page
        return redirect()->to('/login');
    }

    private function generateRandomPassword($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    private function sendNewPasswordEmail($userEmail, $password)
    {
        // Load email library
        $emailService = Services::emailService(); 
        $emailService->setTo($userEmail);
        $emailService->setSubject('New Password');

        $message = 'Your new password is: ' . $password;
        $emailService->setMessage($message);

        // Send email
        if ($emailService->send()) {
            return true;
        } else {
            // Handle email send failure
            echo $emailService->printDebugger();
            return false;
        }
    }
    
}
