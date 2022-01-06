<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Division extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = ['name'];

    protected static $logName       = 'membership';
    protected static $logAttributes = ['name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('membership');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Division :subject.name has been {$eventName} by: :causer.name";
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
