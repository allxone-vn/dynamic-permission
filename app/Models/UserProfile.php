<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'full_name', 'gender', 'address', 'phone_number', 'date_of_birth', 
        'marital_status', 'salary'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
