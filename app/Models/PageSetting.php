<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PageSetting extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'logo',
        'title',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                        ->useLogName('setting')
                        ->logOnly(['logo','title']);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Page Setting has been {$eventName} by: :causer.name";
    }
}
