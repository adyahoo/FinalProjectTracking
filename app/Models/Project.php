<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Auth;

class Project extends Model
{
    use HasFactory, LogsActivity, HasRelationships;

    protected $dates    = [
        'start_date',
        'end_date',
        'launch_date'
    ];

    protected $filter   = [
        'no_filter' => 'no_filter',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'scope',
        'credentials',
        'start_date',
        'end_date',
        'launch_date'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                        ->useLogName('project')
                        ->logOnly(['name', 'description', 'scope', 'credentials', 'start_date', 'end_date']);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Project :subject.name has been {$eventName} by: :causer.name";
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

    public function scopeWhereUserAssignee($query, $userId)
    {
        if (!empty($userId) && $userId != $this->filter['no_filter'])
            return $query->whereHas('projectVersions', function($projectVersions) use($userId){
                $projectVersions->whereHas('projectDetails', function($projectDetails) use($userId){
                    $projectDetails->whereHas('userAssignments', function($userAssignments) use($userId){
                        $userAssignments->where('user_id', $userId);
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
                            $user->where('role_id', $roleId);
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
}
