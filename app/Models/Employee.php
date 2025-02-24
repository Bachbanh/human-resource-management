<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'department',
        'hire_date',
        'salary',
    ];

    // Tự động viết hoa chữ cái đầu cho tên, chức vụ và phòng ban
    public function getNameAttribute($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
    }

    public function getPositionAttribute($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
    }

    public function getDepartmentAttribute($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
    }
}
