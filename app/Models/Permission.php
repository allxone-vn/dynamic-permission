<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['attribute', 'crud_value'];
    public function rolePermissions()
    {
        return $this->hasMany(RolePermission::class);
    }
}
