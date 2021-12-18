<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ProjectVersion extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'project_id', 
        'version_number',
        'note',
        'description',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                        ->useLogName('project')
                        ->logOnly(['project_id','version_number','note','description']);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Project Version has been {$eventName} by: :causer.name";
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function projectDetails()
    {
        return $this->hasMany(ProjectDetail::class);
    }
}
