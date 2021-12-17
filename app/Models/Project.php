<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $dates    = [
        'start_date',
        'end_date',
        'launch_date'
    ];

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'scope',
        'credentials',
        'start_date',
        'end_date',
        'launch_date'
    ];

    public function scopeWhereDueDate($query, $dueDate)
    {
        if (!empty($dueDate))
            return $query->where('end_date', $dueDate);
    }

    // public function scopeWhereRoleAssignee($query, $role)
    // {
    //     if (!empty($role))
    //         return $query->where('end_date', $dueDate);
    // }

    // public function scopeWhereUserAssignee($query, $user)
    // {
    //     if (!empty($user))
    //         return $query->where('end_date', $dueDate);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectVersions()
    {
        return $this->hasMany(ProjectVersion::class);
    }
}
