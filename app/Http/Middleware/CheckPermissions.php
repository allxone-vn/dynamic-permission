<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\UserProfile;
use App\Models\Role;


class CheckPermissions
{
    public function handle($request, Closure $next, $attribute, $action)
    {
        $user = Auth::user();

        // Lấy userProfile của user
        $userProfile = $user->userProfile;

        // Kiểm tra quyền của role dựa trên attribute và action
        $permission = Permission::where('attribute', $attribute)
                                ->where('crud_value', 'like', '%' . $action . '%')
                                ->first();

        if ($permission && $user->role->permissions->contains($permission)) {
            // Kiểm tra xem user có quyền truy cập attribute này không
            switch ($action) {
                case 'read':
                    // Check quyền read
                    if ($permission->crud_value[0] === '1') {
                        return $next($request);
                    }
                    break;
                case 'write':
                    // Check quyền write
                    if ($permission->crud_value[1] === '1') {
                        return $next($request);
                    }
                    break;
                case 'update':
                    // Check quyền update
                    if ($permission->crud_value[2] === '1') {
                        return $next($request);
                    }
                    break;
                case 'delete':
                    // Check quyền delete
                    if ($permission->crud_value[3] === '1') {
                        return $next($request);
                    }
                    break;
                default:
                    break;
            }
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
