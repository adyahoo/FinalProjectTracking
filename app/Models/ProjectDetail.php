<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class ProjectDetail extends Model
{
    use HasFactory;

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

    public function scopeWhereDone($query)
    {
        return $query->where('status', 'done');
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

    public function projectVersion()
    {
        return $this->belongsTo(ProjectVersion::class);
    }

    public function moduleable()
    {
        return $this->morphTo();
    }

    public function user_assigments()
    {
        return $this->hasMany(UserAssignment::class);
    }
}
