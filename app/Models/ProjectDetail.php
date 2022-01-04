<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ProjectDetail extends Model
{
    use HasFactory, LogsActivity;

    public $statusOption = [
        'finish'      => 'Finish',
        'testing'     => 'Testing',
        'on_progress' => 'On Progress',
        'pending'     => 'Pending',
        'open'        => 'Open'
    ];

    public $moduleType = [
        'module'         => 'App\Models\Module',
        'special_module' => 'App\Models\SpecialModule'
    ];

    protected $fillable = [
        'project_version_id',
        'moduleable_type',
        'moduleable_id',
        'status',
        'special_module',
        'start_date',
        'end_date',
        'start_date_actual',
        'end_date_actual',
        'realization',
    ];

    protected static $logName       = 'project';
    protected static $logAttributes = ['status', 'start_date', 'end_date', 'start_date_actual', 'end_date_actual', 'realization'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Module has been {$eventName} on this project by: :causer.name";
    }

    public function getStartDateAttribute()
    {
        $datetime = new DateTime($this->attributes['start_date']);

        return $datetime;
    }

    public function getEndDateAttribute()
    {
        $datetime = new DateTime($this->attributes['end_date']);

        return $datetime;
    }

    public function getStartDateActualAttribute()
    {
        if(empty($this->attributes['start_date_actual'])) {
            $datetime = $this->attributes['start_date_actual'];
        } else {
            $datetime = new DateTime($this->attributes['start_date_actual']);
        }

        return $datetime;
    }

    public function getEndDateActualAttribute()
    {
        if(empty($this->attributes['end_date_actual'])) {
            $datetime = $this->attributes['end_date_actual'];
        } else {
            $datetime = new DateTime($this->attributes['end_date_actual']);
        }

        return $datetime;
    }

    public function scopeWhereDone($query)
    {
        return $query->where('status', $this->statusOption['finish']);
    }

    public function scopeWhereDoneOrOnProgress($query)
    {
        return $query->where('status', $this->statusOption['finish'])->orWhere('status', $this->statusOption['on_progress']);
    }

    public function scopeWhereUserAssignee($query, $userId)
    {
        if (!empty($userId))
            return $query->whereHas('userAssignments', function($userAssignments) use($userId){
                $userAssignments->where('user_id', $userId);
            });
    }

    public function scopeWhereVersion($query, $versionId)
    {
        if(!empty($versionId)) {
            return $query->where('project_version_id', $versionId);
        }
    }

    public function projectVersion()
    {
        return $this->belongsTo(ProjectVersion::class);
    }

    public function moduleable()
    {
        return $this->morphTo();
    }

    public function userAssignments()
    {
        return $this->hasMany(UserAssignment::class);
    }
}
