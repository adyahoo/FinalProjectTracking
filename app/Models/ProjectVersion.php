<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 
        'version_number',
        'note',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function project_details()
    {
        return $this->hasMany(ProjectDetail::class);
    }
}
