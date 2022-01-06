<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class BlogCategories extends Model
{
    use HasFactory , LogsActivity;

    protected $fillable = ['name'];

    protected static $logName       = 'blog';
    protected static $logAttributes = ['name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('blog');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Blog Categories :subject.name has been {$eventName} by: :causer.name";
    }

    public function blog()
    {
        return $this->hasMany(Blog::class);
    }
}
