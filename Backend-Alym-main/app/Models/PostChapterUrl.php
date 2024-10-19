<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostChapterUrl extends Model
{
    use HasFactory;

    protected $fillable = [
      "chapter_id",
      "url",
      "downloaded"
    ];
}
