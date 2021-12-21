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
        'done'        => 'done',
        'not_yet'     => 'not yet',
        'on_progress' => 'on progress'
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

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Module has been {$eventName} on this project by: :causer.name";
    }

    public function scopeWhereDone($query)
    {
        return $query->where('status', $this->statusOption['done']);
    }

    public function scopeWhereDoneOrOnProgress($query)
    {
        return $query->where('status', $this->statusOption['done'])->orWhere('status', $this->statusOption['on_progress']);
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
