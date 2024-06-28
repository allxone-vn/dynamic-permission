<?php

namespace App\Services;

use App\Models\RolePermission;

class PermissionService
{
    public function getUserPermissions($roleId)
    {
        return RolePermission::where('role_id', $roleId)
            ->join('permissions', 'role_permissions.permission_id', '=', 'permissions.id')
            ->pluck('permissions.crud_value', 'permissions.attribute')
            ->toArray();
    }
}
