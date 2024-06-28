<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\RolePermissionModel;
use App\Models\PermissionModel;
use App\Models\UserModel;
use App\Models\Profiles;

class PermissionSelect extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        // Load models
        $roleModel = new RoleModel();
        $rolePermissionModel = new RolePermissionModel();
        $permissionModel = new PermissionModel();
        $userModel = new UserModel();
        $profilesModel = new Profiles();
        $session = session();
        $role_id = $session->get('role_id');
        // Get the permission names for the HR role
        $builder = $db->table('role r')
            ->select('p.PermissonName AS quyen')
            ->join('role_permission rp', 'r.role_id = rp.role_id')
            ->join('permission p', 'rp.IDPer = p.IDPer')
            ->where('r.role_id', $role_id)
            ->where('SUBSTRING(p.Value, 2, 1)', '1');

        $query = $builder->get();
        $quyenColumns = $query->getResultArray();

        // Convert the result to a list of columns
        $columns = array_map(function($column) {
            return $column['quyen'];
        }, $quyenColumns);
        // Get user data based on the columns
        $userData = $profilesModel->select($columns)->findAll();

        // Load view and pass data
        $data = [
            'title' => 'rolePersonnel',
            'content' => view('page/rolePersonnel', ['userData' => $userData])
        ];

        echo view('LayoutEmploye', $data);
    }
}
?>
