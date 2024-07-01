<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $attributes = Permission::select('attribute')->distinct()->get();

        // Lấy danh sách các bảng trong database
        $tables = $this->getDatabaseTables();
        return view('permission', compact('roles', 'attributes', 'tables'));
    }

    // Hàm để lấy danh sách các bảng trong database
    protected function getDatabaseTables()
    {
        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current', $tables);

        // Loại bỏ các bảng mặc định và bảng của Laravel
        $excludeTables = ['roles', 'permissions', 'role_permissions', 'users', 'migrations'];
        $tables = array_diff($tables, $excludeTables);

        return $tables;
    }

    public function update(Request $request)
    {
        $roleId = $request->input('role_id');
        $crudData = $request->input('crud', []);
    
        foreach ($crudData as $attribute => $crudValues) {
            if (!is_array($crudValues)) {
                continue; // Skip if crudValues is not an array
            }
    
            // Initialize an array to store the crud values
            $crudArray = [
                'create' => 0,
                'read' => 0,
                'update' => 0,
                'delete' => 0,
            ];
    
            // Set 1 for checked checkboxes
            foreach ($crudValues as $value) {
                if (array_key_exists($value, $crudArray)) {
                    $crudArray[$value] = 1;
                }
            }
    
            // Create the crudValue string
            $crudValue = implode('', array_values($crudArray));
            // dd($crudValue);
    
            // Find the permission based on the attribute and crud value
            $permission = Permission::where('attribute', $attribute)->where('crud_value', $crudValue)->first();
    
            // Check if a permission already exists for this role and attribute
            $existingRolePermission = RolePermission::where('role_id', $roleId)
                ->whereHas('permission', function ($query) use ($attribute) {
                    $query->where('attribute', $attribute);
                })
                ->first();
    
            if ($permission) {
                if ($existingRolePermission) {
                    // Update the existing RolePermission with the new permission_id
                    $existingRolePermission->permission_id = $permission->id;
                    $existingRolePermission->save();
                } else {
                    // Create a new RolePermission
                    RolePermission::create([
                        'role_id' => $roleId,
                        'permission_id' => $permission->id,
                    ]);
                }
            } else {
                if ($existingRolePermission) {
                    // Delete the existing RolePermission if no permission matches the crud value
                    $existingRolePermission->delete();
                }
            }
        }
    
        return redirect()->back()->with('success', 'Permissions updated successfully.');
    }
} 
