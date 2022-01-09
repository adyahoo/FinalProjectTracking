<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;

class UserAssignment extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'project_detail_id',
    ];

    protected static $logName       = 'project';
    protected static $logAttributes = ['user_id', 'project_detail_id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('project');
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = ['project_id' => $this->projectDetail->projectVersion->project_id];
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $user           = User::find($this->user_id);
        $project_detail = ProjectDetail::find($this->project_detail_id);
        $project        = Project::find($project_detail->project_id);
        
        if($eventName == 'created'){
            return "User {$user->name} has been assigned to Project {$project_detail->projectVersion->project->name} on Module {$project_detail->moduleable->name} by: :causer.name";
        }
        return "User {$user->name} has been {$eventName} on Project {$project_detail->projectVersion->project->name} by: :causer.name";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectDetail()
    {
        return $this->belongsTo(ProjectDetail::class);
    }
}
