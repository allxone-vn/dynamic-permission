<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Support\Facades\DB;
use Schema;

class PermissionController extends Controller
{
        public function index(Request $request)
    {
        $roles = Role::all();
        $tables = $this->getDatabaseTables();
        $attributes = [];
        
        $selectedTable = $request->get('table_name');
        
        if ($selectedTable) {
            // Lấy các thuộc tính của bảng đã chọn từ bảng permissions
            $attributes = Permission::where('table_name', $selectedTable)
                ->select('attribute')
                ->distinct()
                ->get();
        }
        
        return view('permission', compact('roles', 'attributes', 'tables', 'selectedTable'));
    }

    // Hàm để lấy danh sách các bảng trong database
    protected function getDatabaseTables()
    {
        $tables = DB::select('SHOW TABLES');
        $tables = array_map('current', $tables);

        // Loại bỏ các bảng mặc định và bảng của Laravel
        $excludeTables = ['roles', 'permissions', 'role_permissions', 'users', 'migrations', 'sessions'];
        $tables = array_diff($tables, $excludeTables);

        return $tables;
    }

    public function getAttributes(Request $request)
{
    $tableName = $request->get('table_name');
    $attributes = Permission::where('table_name', $tableName)
        ->select('attribute')
        ->distinct()
        ->get();

    return response()->json($attributes);
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


    public function updateTablePermissions()
    {
        // Định nghĩa các giá trị CRUD
        $crudValues = [
            '0000', '0001', '0010', '0011',
            '0100', '0101', '0110', '0111',
            '1000', '1001', '1010', '1011',
            '1100', '1101', '1110', '1111',
        ];

        // Lấy danh sách tất cả các bảng trong cơ sở dữ liệu
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        // Loại bỏ các bảng mặc định của Laravel
        $excludeTables = ['migrations', 'users', 'password_resets', 'roles', 'permissions', 'role_permission', 'sessions', 'role_permission']; // Thêm các bảng khác mà bạn muốn loại trừ vào đây

        foreach ($tables as $table) {
            if (!in_array($table, $excludeTables)) {
                // Kiểm tra xem table_name đã tồn tại trong bảng permissions chưa
                $exists = DB::table('permissions')->where('table_name', $table)->exists();

                if (!$exists) {
                    // Lấy danh sách các cột của bảng
                    $columns = Schema::getColumnListing($table);

                    // Loại bỏ các cột id, created_at, updated_at
                    $filteredColumns = array_diff($columns, ['id', 'created_at', 'updated_at']);

                    // Chèn dữ liệu vào bảng permissions
                    foreach ($filteredColumns as $column) {
                        foreach ($crudValues as $crudValue) {
                            DB::table('permissions')->insert([
                                'attribute' => $column,
                                'crud_value' => $crudValue,
                                'table_name' => $table,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->back()->with('success', 'Permissions updated successfully.');
    }
    
} 
