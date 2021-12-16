<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

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
}
