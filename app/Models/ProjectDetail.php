<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_version_id',
        'module_id',
        'status',
        'special_module',
        'start_date',
        'end_date',
        'start_date_actual',
        'end_date_actual',
        'realization',
    ];

    public function projectVersion()
    {
        return $this->belongsTo(ProjectVersion::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function user_assigments()
    {
        return $this->hasMany(UserAssignment::class);
    }
}
