<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $privileges    = [
        'admin'           => 'admin',
        'project_manager' => 'project_manager',
        'employee'        => 'employee'
    ];

    protected $fillable = ['name', 'privilege'];

    public function scopeWhereEmployee($query)
    {
        return $query->where('privilege', $this->privileges['employee']);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
