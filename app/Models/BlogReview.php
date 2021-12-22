<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class BlogReview extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'blog_id',
        'user_id',
        'status',
        'reviews',
    ];

    protected static $logName       = 'blog';
    protected static $logAttributes = ['status', 'reviews'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Blog Review has been {$eventName} by: :causer.name";
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
