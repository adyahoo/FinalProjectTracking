<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use App\Traits\ImageTrait;
use Auth;

class Project extends Model
{
    use HasFactory, LogsActivity, HasRelationships, SoftDeletes, ImageTrait;

    const IMAGE_PATH    = 'public/project_logo/';

    protected $dates    = [
        'start_date',
        'end_date',
        'launch_date',
        'deleted_at'
    ];

    protected $filter   = [
        'no_filter' => 'no_filter',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'logo',
        'scope',
        'credentials',
        'start_date',
        'end_date',
        'total_estimated_days',
        'launch_date'
    ];

    protected static $logName       = 'project';
    protected static $logAttributes = ['name', 'description', 'scope', 'credentials'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('project');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Project :subject.name has been {$eventName} by: :causer.name";
    }

    public function setLogoAttribute($value){
        $this->attributes['logo'] = $this->uploadImage($value, self::IMAGE_PATH);
    }

    public function scopeWhereProjectManager($query, $projectManager)
    {
        if (!empty($projectManager) && $projectManager != $this->filter['no_filter'])
            return $query->where('user_id', $projectManager);
    }

    public function scopeWhereMyProject($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function scopeWhereStartDate($query, $startDate)
    {
        if (!empty($startDate))
            return $query->where('start_date', '>=', $startDate);
    }

    public function scopeWhereEndDate($query, $endDate)
    {
        if (!empty($endDate))
            return $query->where('end_date', '<=', $endDate);
    }

    public function scopeWhereLaunched($query)
    {
        return $query->whereNotNull('launch_date');
    }

    public function scopeWhereUserAssignee($query, $userId)
    {
        if (!empty($userId) && $userId != $this->filter['no_filter'])
            return $query->whereHas('projectVersions', function($projectVersions) use($userId){
                $projectVersions->whereHas('projectDetails', function($projectDetails) use($userId){
                    $projectDetails->whereHas('userAssignments', function($userAssignments) use($userId){
                        $userAssignments->whereIn('user_id', $userId);
                    });
                });
            });
    }

    public function scopeWhereRoleAssignee($query, $roleId)
    {
        if (!empty($roleId) && $roleId != $this->filter['no_filter'])
            return $query->whereHas('projectVersions', function($projectVersions) use($roleId){
                $projectVersions->whereHas('projectDetails', function($projectDetails) use($roleId){
                    $projectDetails->whereHas('userAssignments', function($userAssignments) use($roleId){
                        $userAssignments->whereHas('user', function($user) use($roleId){
                            $user->whereIn('role_id', $roleId);
                        });
                    });
                });
            });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectVersions()
    {
        return $this->hasMany(ProjectVersion::class);
    }

    public function userAssignments()
    {
        return $this->hasManyDeep(UserAssignment::class, [ProjectVersion::class, ProjectDetail::class]);
    }

    public function projectDetails()
    {
        return $this->hasManyDeep(ProjectDetail::class, [ProjectVersion::class]);
    }

    public function roles()
    {
        $roles = [];
        foreach($this->userAssignments()->get() as $userAssignment) {
            $roles[] += $userAssignment->user->role_id;
        }

        return $roles;
    }
}
