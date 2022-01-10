<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Traits\ImageTrait;

class PageSetting extends Model
{
    use HasFactory, LogsActivity, ImageTrait;
    
    const IMAGE_PATH    = 'public/app_logo/';

    protected $fillable = [
        'logo',
        'title',
    ];

    protected static $logName       = 'setting';
    protected static $logAttributes = ['title','logo'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('setting');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Page Setting has been {$eventName} by: :causer.name";
    }

    public function setLogoAttribute($value){
        $this->attributes['logo'] = $this->uploadImage($value, self::IMAGE_PATH);
    }
}
