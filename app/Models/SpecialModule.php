<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SpecialModule extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'description',
        'time_estimation',
    ];

    protected static $logName       = 'projectSpecialModule';
    protected static $logAttributes = ['name', 'description', 'time_estimation'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('projectSpecialModule');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Special Module :subject.name has been {$eventName} by: :causer.name";
    }

    public function project_detail()
    {
        return $this->morphOne(ProjectDetail::class, 'moduleable');
    }
}
