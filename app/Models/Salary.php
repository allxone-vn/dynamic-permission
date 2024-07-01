<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'basic_salary',
        'allowance',
        'social_insurance',
        'health_insurance',
        'unemployment_insurance',
        'personal_income_tax',
        'total_salary',
    ];

    // Định nghĩa quan hệ 1-1 với model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
