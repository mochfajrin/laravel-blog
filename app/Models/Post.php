<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        "user_id",
        "title",
        "slug",
        "body",
        "image",
        "published_at",
        "featured"
    ];
    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function scopePublished($query)
    {
        $query->where("published_at", "<=", Carbon::now());
    }
    public function scopeFeatured($query)
    {
        $query->where("featured", true);
    }
    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas("categories", function ($query) use ($category) {
            $query->where("slug", $category);
        });
    }
    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->body), 150);
    }
    public function getReadingTime()
    {
        return ceil(str_word_count($this->body) / 250);
    }
    public function getThumbnailUrl()
    {
        $isUrl = str_contains($this->image, "http");
        return $isUrl ? $this->image : Storage::disk("public")->url($this->image);
    }
}
