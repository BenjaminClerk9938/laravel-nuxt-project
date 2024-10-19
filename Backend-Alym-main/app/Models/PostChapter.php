<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PostChapter extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'uuid',
        'post_id',
        'number',
        'source_url',
        "downloaded"
    ];


    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('chapter');
    }
}
