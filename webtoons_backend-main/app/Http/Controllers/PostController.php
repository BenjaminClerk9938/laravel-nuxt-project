<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostChapter;
use App\Models\PostTag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::where('published', true)
            ->with(['chapters' => function($query) {
                return $query->inRandomOrder()->limit(2);
            }])
            ->orderBy('created_at', 'desc');

        if ($filter = $request->input('filter')) {
            if ($filter === 'popular') {
                $query->orderBy('visits', 'desc');
            } elseif ($filter !== 'all') {
                $tag = PostTag::where('slug', $filter)->first();
                if ($tag) {
                    $query->whereJsonContains('tags', $tag->uuid);
                }
            }
        }

        return response()->json($query->paginate(12));
    }


    public function post($slug)
    {
        $post = Post::where("slug", $slug)
            ->with("chapters")
            ->withCount("chapters")
            ->first();

        $post->increment("visits");

        return $post;
    }

    public function chapter(string $slug, int $number)
    {
        $chapter = PostChapter::where("number", $number)
            ->whereHas("post", function ($query) use ($slug) {
                return $query->where("slug", $slug);
            })
            ->first();

        $nextChapter = PostChapter::where("number", $number + 1)
            ->whereHas("post", function ($query) use ($slug) {
                return $query->where("slug", $slug);
            })
            ->first();

        return response()->json([
            "info" => $chapter->post,
            "next_chapter" => $nextChapter,
            "media" => $chapter->getMedia("chapter")
        ]);

    }

    public function search(Request $request)
    {
        $search = $request->search ?? '';

        $posts = Post::where("title", "like", "%$search%")
            ->orWhere("description", "like", "%$search%")
            ->orWhere("alt_titles", "like", "%$search%")
            ->limit(10)
            ->get();

        return response()->json($posts);

    }

    public function tags()
    {
        $tags = PostTag::select('*')
            ->take(3)
            ->get();

        return response()->json($tags);
    }
}
