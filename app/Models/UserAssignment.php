<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
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

    public function getDescriptionForEvent(string $eventName): string
    {
        return "User Assignment has been {$eventName} by: :causer.name";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project_detail()
    {
        return $this->belongsTo(ProjectDetail::class);
    }

}
