<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class ProjectVersion extends Model
{
    use HasFactory, LogsActivity, HasRelationships;

    protected $fillable = [
        'project_id', 
        'version_number',
        'note',
        'description',
    ];

    protected static $logName       = 'project';
    protected static $logAttributes = ['note', 'description'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
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

    public function userAssignments()
    {
        return $this->hasManyDeep(UserAssignment::class, [ProjectDetail::class]);
    }
}
