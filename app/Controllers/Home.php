<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller {

    public function index() {
        $session = session();
        if ($session->get('logged_in')) {
            return view('Home', ['username' => $session->get('username')]);
        } else {
            return redirect()->to('/');
        }
    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
