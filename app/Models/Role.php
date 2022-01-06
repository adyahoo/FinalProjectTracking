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

    public $privileges    = [
        'admin'           => 'admin',
        'project_manager' => 'project_manager',
        'employee'        => 'employee'
    ];

    protected $fillable = ['name', 'privilege'];
    
    protected static $logName = 'membership';
    protected static $logAttributes = ['name', 'privilege'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('membership');
    }

    public function scopeWhereEmployee($query)
    {
        return $query->where('privilege', $this->privileges['employee']);
    }

    public function scopeWhereProjectManager($query)
    {
        return $query->where('privilege', $this->privileges['project_manager']);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Role :subject.name has been {$eventName} by: :causer.name";
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
