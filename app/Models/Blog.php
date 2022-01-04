<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Str;
use Carbon\Carbon;
use Auth;

class Blog extends Model
{
    use HasFactory, ImageTrait, LogsActivity;

    const IMAGE_PATH    = 'public/blog_images/';

    public $statusOption = [
        'draft'              => 'Draft',
        'published'          => 'Published',
        'rejected'           => 'Rejected',
        'waiting_for_review' => 'Waiting for Review'
    ];

    protected $fillable = [
        'user_id', 
        'blog_category_id',
        'title',
        'content',
        'image',
        'view_count',
        'meta_title',
        'meta_description',
        'slug',
        'published_at',
        'status'
    ];

    protected static $logName       = 'blog';
    protected static $logAttributes = ['title'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Blog :subject.title has been {$eventName} by: :causer.name";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategories::class);
    }

    public function blogReviews()
    {
        return $this->hasMany(BlogReview::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value.'-'.Carbon::now(), '-');
    }

    public function setContentAttribute($value){
        $this->attributes['content'] = $this->getImageFromBlogContent($value);
    }

    public function setImageAttribute($value){
        $this->attributes['image'] = $this->uploadImage($value, self::IMAGE_PATH);
    }

    public function scopeGetReviews($query)
    {
        return $query->with('user', 'blogCategory')->where('status', 'Waiting for Review')->orderBy('updated_at', 'desc');
    }

    public function scopeGetWaitingForReview($query)
    {
        return $query->with('user', 'blogCategory')->where('status', 'Published')->orWhere('status', 'Rejected')->orderBy('updated_at', 'desc');
    }

    public function scopeMyBlogs($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }
}
