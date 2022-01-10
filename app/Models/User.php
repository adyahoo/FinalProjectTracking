<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Hash;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Traits\ImageTrait;
use Overtrue\LaravelLike\Traits\Liker;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity, ImageTrait, Liker;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    const IMAGE_PATH    = 'public/profile_images/';
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'role_id',
        'division_id',
        'phone',
        'profile_image',
        'birth_date',
        'bio'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static $logName       = 'membership';
    protected static $logAttributes = ['name', 'email'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->useLogName('membership')
                ->dontLogIfAttributesChangedOnly(['password', 'updated_at', 'remember_token']);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "User with name :subject.name has been {$eventName} by: :causer.name";
    }

    public function getIsAdminAttribute()
    {
        return ($this->role->privilege == $this->role->privileges['admin']);
    }

    public function getIsProjectManagerAttribute()
    {
        return ($this->role->privilege == $this->role->privileges['project_manager']);
    }

    public function getIsEmployeeAttribute()
    {
        return ($this->role->privilege == $this->role->privileges['employee']);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = !$value ?  null : Hash::make($value);
    }

    public function setProfileImageAttribute($value)
    {
        $this->attributes['profile_image'] = $this->uploadImage($value, self::IMAGE_PATH);
    }

    public function scopeWhereEmployee($query)
    {
        return $query->whereHas('role', function($role){
            $role->where('privilege', (new Role())->privileges['employee']);
        });
    }

    public function scopeWhereProjectManager($query)
    {
        return $query->whereHas('role', function($role){
            $role->where('privilege', (new Role())->privileges['project_manager']);
        });
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function user_assignments()
    {
        return $this->hasMany(UserAssignment::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function review()
    {
        return $this->hasMany(BlogReview::class);
    }
}
