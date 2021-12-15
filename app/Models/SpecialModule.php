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
        'start_date',
        'end_date'
    ];

    public function project_detail()
    {
        return $this->morphOne(ProjectDetail::class, 'moduleable');
    }
}
