<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'time_estimation',
    ];

    public function project_detail()
    {
        return $this->morphOne(ProjectDetail::class, 'moduleable');
    }
}
