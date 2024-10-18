<?php

namespace App\Livewire;

use App\Jobs\AddChapters;
use App\Models\Post;
use App\Models\PostChapter;
use App\Models\PostTag;
use App\Services\ManhwaClanService;
use Exception;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Ramsey\Uuid\Uuid;

class PostSearch extends Component
{

    public $search;

    public $results = [];

    public  $url;

    protected $rules = [
        'url' => 'required|url',
    ];


    public function render()
    {
        if(count($this->results) == 0) $this->searchPosts();
        return view('livewire.post-search');
    }

    public function searchPosts() {
        $api = new ManhwaClanService();
        $this->results = $api->search($this->search ?? "a");
    }

    public function savePost($post)
    {

        $this->validate();

        try {
            $slug = Str::slug($post["title"]);

            if (Post::where("slug", $slug)->exists()) {
                Notification::make()
                    ->title('This post is already saved')
                    ->success()
                    ->send();
                $this->reset(["url"]);
                $this->dispatch(["finished"]);
                return;
            }

            $api = new ManhwaClanService();
            $apiResponse = $api->details($post["apiUrl"]);

            $tagIds = collect($apiResponse['genres'] ?? [])->map(function($tag) {
                return PostTag::updateOrCreate(
                    ["slug" => Str::slug($tag)],
                    ["name" => trim($tag), "uuid" => Uuid::uuid4()]
                )->uuid;
            });

            $newPost = Post::create([
                'slug' => $slug,
                'title' => $apiResponse['mangaTitle'],
                'alt_titles' => $apiResponse['alternative'] ?: null,
                'tags' => $tagIds,
                'description' => $apiResponse['summary'] ?: null,
                'cover' => $apiResponse['imageUrl'],
                'rating' => $apiResponse['rating'],
                'category' => 'Manga',
                'status' => Str::slug($apiResponse['status'] ?? 'unknown'),
                'published' => 1,
                'views' => $apiResponse['rank'],
                'fake_url' => $this->url,
            ]);

            try {
                $newPost->addMediaFromUrl($apiResponse['imageUrl'])->toMediaCollection('cover');
            } catch (Exception $exception) {
                Log::error('Error adding media to post: ' . $exception->getMessage());
            }

            for ($i = 1; $i <= $apiResponse['chapters']; $i++) {
                $chapter = PostChapter::create([
                    "post_id" => $newPost->id,
                    'uuid' => Uuid::uuid4(),
                    "number" => $i,
                    "source_url" => "https://manhwa-clan.vercel.app/api/$slug/$i/images"
                ]);

                $images = $api->images($post['title'], $i);
                dispatch(new AddChapters($chapter, $images));
            }

            Notification::make()
                ->title('Saved successfully')
                ->success()
                ->send();
            $this->dispatch(["finished"]);

        } catch (Exception $exception) {
            Log::error('Error saving post: ' . $exception->getMessage());
            Notification::make()
                ->title('An error occurred while saving the post')
                ->danger()
                ->send();
            $this->dispatch(["finished"]);
        }

    }

    public function postExists($title)
    {
        $slug = Str::slug($title);
        $post = Post::where("slug", $slug)->exists();

        if($post) {
            Notification::make()
                ->title('This post is already saved')
                ->success()
                ->send();
        }

        $this->dispatch("exists", $post);
    }
}
