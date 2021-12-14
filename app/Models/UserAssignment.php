<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_detail_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project_detail()
    {
        return $this->belongsTo(ProjectDetail::class);
    }

}
