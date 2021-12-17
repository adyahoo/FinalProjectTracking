<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Auth;

class Role extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = ['name','privilege'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                        ->useLogName('role')
                        ->logOnly(['name','privilege']);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Role has been {$eventName} by ". Auth::user()->name;
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
