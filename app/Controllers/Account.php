<?php
namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\DepartmentModel;
use App\Models\UserModel;
use App\Models\Profiles;

class Account extends BaseController
{
    public function show()
    {
        $userModel = new UserModel();
        $session = session();

        // Get the username from the session
        $username = $session->get('username');
        $user = $userModel->findByEmail($username);

        $data = [
            'title' => 'Create Employee',
            'content' => view('page/Account', ['user' => $user])
        ];
        if ($username === 'admin') {
            echo view('layout', $data);
        } else {
            echo view('LayoutEmploye', $data);
        }
    }

    public function disconnectGoogle()
    {
        $userModel = new UserModel();
      $session = session();

        // Get the username from the session
        $username = $session->get('username');
        $user = $userModel->findByEmail($username);

        if ($user) {
            $userModel->disconnectGoogle($user['UserID']);
        }

        return redirect()->to('/account');
    }
}
?>
