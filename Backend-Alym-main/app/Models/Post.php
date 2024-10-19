<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements  HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'slug',
        'title',
        'alt_titles',
        'tags',
        'author',
        'description',
        'cover',
        'rating',
        'category',
        'status',
        'published',
        'year',
        'views',
        'visits',
        'fake_url',
    ];

    protected $casts = [
        "alt_titles" => "array",
        "tags" => "array",
        "author" => "array",
    ];

    protected function tags(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return array_filter(
                    array_map(
                        fn ($item) => PostTag::firstWhere('uuid', $item)?->name,
                        $this->castAttribute('tags', $value)
                    )
                );
            }
        );
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(PostChapter::class, "post_id", "id");
    }

    protected function cover(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->getFirstMedia('cover')->getFullUrl() ?: null;
            }
        );
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover');
    }
}
