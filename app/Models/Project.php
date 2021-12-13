<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $dates    = ['start_date', 'end_date'];
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'scope',
        'credentials',
        'start_date',
        'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project_details()
    {
        return $this->hasMany(ProjectDetail::class);
    }
}
