<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\RolePermissionModel;
use App\Models\PermissionModel;

class createRoleC extends BaseController
{
    public function index()
    {
        $roleModel = new RoleModel();
        $roles = $roleModel->findAll();

        $data = [
            'title' => 'Create Permission',
            'roles' => $roles,
            'content' => view('page/createRole', ['roles' => $roles])
        ];

        echo view('layout', $data);
    }
    public function submit_form()
    {
        // Lấy dữ liệu từ biểu mẫu
        $role_name = $this->request->getPost('role_name');
        $permissions = $this->request->getPost('permission_values');
    
        // Kiểm tra xem role đã tồn tại chưa trước khi thêm mới
        $roleModel = new RoleModel();
        $existingRole = $roleModel->where('role_name', $role_name)->first();
    
        if ($existingRole) {
            // Role đã tồn tại, xử lý thông báo lỗi
            session()->setFlashdata('error', 'Role with name already exists.');
            return redirect()->to('/createRole'); // Redirect back to form or appropriate page
        }
    
    
        // Thêm mới Role và lấy role_id
        $role_id = $roleModel->insert(['role_name' => $role_name]);
    
        // Duyệt qua các permissions
        foreach ($permissions as $permission_string) {
            // Tách permission_name và value từ chuỗi
            $permission_data = explode(' ', trim($permission_string));
            $permission_name = substr($permission_data[0], 1, -1); // loại bỏ ký tự '[' và ']'
            $value = $permission_data[1];
    
            // Kiểm tra và thêm mới hoặc cập nhật Permission
            $permissionModel = new PermissionModel();
            $permission = $permissionModel->where('PermissonName', $permission_name)->where('Value', $value)->first();
            if (!$permission) {
                // Nếu không tồn tại, thêm mới permission
                $permission_id = $permissionModel->insert(['PermissonName' => $permission_name, 'Value' => $value]);
            } else {
                // Nếu tồn tại, lấy IDPer của permission đã có
                $permission_id = $permission['IDPer'];
            }
    
            // Thêm mới hoặc cập nhật Role-Permission mappings
            $rolePermissionModel = new RolePermissionModel();
            $rolePermissionModel->updateOrCreate($role_id, $permission_id);
        }
    
        // Thông báo thành công hoặc chuyển hướng tùy vào yêu cầu của bạn
        session()->setFlashdata('success', 'Role created successfully.');
        return redirect()->to('/createRole');
    }
    

}