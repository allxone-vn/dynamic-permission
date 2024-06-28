<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;

class PermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $attributes = Permission::select('attribute')->distinct()->get();
        return view('permission', compact('roles', 'attributes'));
    }

    public function update(Request $request)
    {
        $roleId = $request->input('role_id');
        $attribute = $request->input('attribute');
        $crudValues = $request->input('crud', []);
    
        // Initialize an array to store the crud values
        $crudArray = [
            'create' => 0,
            'read' => 0,
            'update' => 0,
            'delete' => 0,
        ];
    
        // Set 1 for checked checkboxes
        foreach ($crudValues as $value) {
            if (isset($crudArray[$value])) {
                $crudArray[$value] = 1;
            }
        }
    
        // Create the crudValue string
        $crudValue = implode('', array_values($crudArray));
        //dd($crudValue);
    
        // Now you have $crudValue like '1000', '1100', etc. based on checked checkboxes
    
        $permission = Permission::where('attribute', $attribute)->where('crud_value', $crudValue)->first();
        //dd($permission);
        if ($permission) {
            RolePermission::updateOrCreate(
                ['role_id' => $roleId, 'permission_id' => $permission->id],
                ['role_id' => $roleId, 'permission_id' => $permission->id]
            );
        } else {
            // Xóa nếu không có quyền này
            RolePermission::where('role_id', $roleId)
                ->whereHas('permission', function ($query) use ($attribute) {
                    $query->where('attribute', $attribute);
                })
                ->delete();
        }
    
        return redirect()->back()->with('success', 'Permissions updated successfully.');
    }
    
}
