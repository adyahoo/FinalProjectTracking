<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ImageTrait;
use Str;

class Blog extends Model
{
    use HasFactory, ImageTrait;

    const IMAGE_PATH    = 'public/blog_images/';
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategories::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setContentAttribute($value){
        $this->attributes['content'] = $this->getImageFromBlogContent($value);
    }

    public function setImageAttribute($value){
        $this->attributes['image'] = $this->uploadImage($value, self::IMAGE_PATH);
    }
}
