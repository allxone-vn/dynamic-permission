<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\RolePermissionModel;
use App\Models\PermissionModel;
use App\Models\Profiles;
class Permission extends BaseController
{
    public function index()
    {
        $roleModel = new RoleModel();
        $roles = $roleModel->findAll();
    
        // Lấy danh sách các bảng từ cơ sở dữ liệu (ví dụ)
        $db = \Config\Database::connect();
        $tables = $db->listTables();
    
        $data = [
            'title' => 'Create Permission',
            'roles' => $roles,
            'tables' => $tables, // Thêm danh sách tên bảng vào data
            'content' => view('page/createPermission', ['roles' => $roles, 'tables' => $tables])
        ];
    
        echo view('layout', $data);
    }
    

  
    public function getTableColumnNames()
    {
        $tableName = $this->request->getGet('tableName'); // Assuming passed through GET request
        
        // Validate table name to prevent SQL injection or errors if needed
       
        $db = \Config\Database::connect();
        $fields = $db->getFieldData($tableName);
    
        $excludedColumns = [
            'department_id',
            'UserID',
            'created_at',
            'updated_at',
            'IDProfiles',
            'id',
            'ID'
        ];
    
        $columnNames = [];
        foreach ($fields as $field) {
            if (!in_array($field->name, $excludedColumns)) {
                $columnNames[] = $field->name;
            }
        }
    
        return $this->response->setJSON($columnNames);
    }
    


    // public function updatePermission()
    // {
    //     $permissionModel = new PermissionModel();
    //     $rolePermissionModel = new RolePermissionModel();

    //     $roleId = $this->request->getPost('role_id');
    //     $rolePermissionId = $this->request->getPost('rolepermissionId');
    //     $permissionName = $this->request->getPost('PermissonName');
    //     $value = $this->request->getPost('value');
     
    //     if (empty($roleId) || empty($rolePermissionId) || empty($permissionName) || empty($value)) {
    //         return $this->response->setJSON(['status' => 'error', 'message' => 'All fields are required.']);
    //     }
    //     try {
    //     // Check if permission exists
    //     if ($value !== '1000' && $value[1] == '0') {
    //        return $this->response->setJSON(['status' => 'error', 'message' => 'Without read permission, the value cannot be updated.']);
    //    }
    //     $permission = $permissionModel->where('PermissonName', $permissionName)
    //                                   ->where('Value', $value)
    //                                   ->first();

    //     if ($permission) {
    //         // Permission exists, get IDPer
    //         $IDPer = $permission['IDPer'];
    //     } else {
    //         // Permission does not exist, create new one
    //         $IDPer = $permissionModel->insert([
    //             'PermissonName' => $permissionName,
    //             'Value' => $value,
    //             'created_at' => date('Y-m-d H:i:s'),
    //             'updated_at' => date('Y-m-d H:i:s')
    //         ]);
    //     }

    //     // Update role_permission with the IDPer
    //     $rolePermissionModel->update($rolePermissionId, [
    //         'IDPer' => $IDPer,
    //         'updated_at' => date('Y-m-d H:i:s')
    //     ]);
    //     return $this->response->setJSON(['status' => 'success', 'message' => 'Permission updated successfully.']);
    //     } catch (\Exception $e) {
    //         return $this->response->setJSON(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
    //     }
    // }
    // public function updatePermission() {
    //     $postData = $this->request->getJSON();
    //     var_dump(  $postData);      
    //     $permissionModel = new PermissionModel();
    //     $rolePermissionModel = new RolePermissionModel();
    //     if (!$permissions || !isset($permissions['permissions']) || empty($permissions['permissions'])) {
    //         return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid or empty permissions data']);
    //     }
    //         // Process each permission entry
    //         foreach ($permissions as $permission) {
    //             $roleId = $permission['role_id'];
    //             $columnName = $permission['column_name'];
    //             $permissionValue = $permission['permission_value'];
              
    //             // Check if permission exists
    //             $existingPermission = $permissionModel->where('PermissonName', $columnName)
    //             ->where('Value', $permissionValue)
    //             ->first();
                
    //             var_dump($permission);
    //             if ($existingPermission) {
    //                 // Permission exists, get IDPer
    //                 $IDPer = $existingPermission['IDPer'];
    //             } else {
    //                 // Permission does not exist, create new one
    //                 $IDPer = $permissionModel->insert([
    //                     'PermissionName' => $columnName,
    //                     'Value' => $permissionValue,
    //                     'created_at' => date('Y-m-d H:i:s'),
    //                     'updated_at' => date('Y-m-d H:i:s')
    //                 ]);
    //             }
    
    //             // Update role_permission with the IDPer
    //             $rolePermissionModel->updatePermission($roleId, $IDPer);
    //         }
    
    //         // Return success response
    //         return $this->response->setJSON(['status' => 'success', 'message' => 'Permissions updated successfully']);
       
    // }
    
    
    public function updatePermission()
    {
        $postData = $this->request->getJSON();
        if (!empty($postData)) {
            var_dump(  $postData);
            $permissionModel = new PermissionModel();
            $rolePermissionModel = new RolePermissionModel();
            $response = [];
            foreach ($postData as $item) {
                $role_id = $item->role_id;
                $column_name = $item->column_name;
                $permission_value = $item->permission_value;
    
                // Check if permission exists
                $existingPermission = $permissionModel->where('PermissonName', $column_name)
                    ->where('Value', $permission_value)
                    ->first();
    
                if ($existingPermission) {
                    // Permission exists, update it if necessary
                    $IDPer = $existingPermission['IDPer'];
                    // Update logic if needed, example:
                    $permissionModel->update($IDPer, [
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    // Permission does not exist, create new one
                    $IDPer = $permissionModel->insert([
                        'PermissonName' => $column_name,
                        'Value' => $permission_value,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
    
                $rolePermissionModel->updatePermission($role_id, $IDPer);
            // Return JSON response
            return $this->response->setJSON(['success' => true]);
            }
        }
        
    }
}

?>
