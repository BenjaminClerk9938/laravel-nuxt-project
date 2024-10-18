<?php

namespace App\Console\Commands;

use App\Jobs\AddChapters;
use App\Models\Post;
use App\Models\PostChapter;
use App\Services\ManhwaClanService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class CheckChapters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-chapters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update chapters count';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $api = new ManhwaClanService();

        $posts = Post::where('status', 'ongoing')->withCount('chapters')->get();

        foreach ($posts as $post) {
            if ($res = $api->search($post->title)) {
                $postDetail = $api->details($res[0]['apiUrl']);
                $newChapters = $postDetail['chapters'] ?? 0;

                if ($newChapters > $post->chapters_count) {
                    for ($i = $post->chapters_count; $i <= $newChapters; $i++) {
                        $chapter = PostChapter::create([
                            'post_id' => $post->id,
                            'uuid' => Uuid::uuid4(),
                            'number' => $i,
                            'source_url' => "https://manhwa-clan.vercel.app/api/$post->slug/$i/images"
                        ]);

                        dispatch(new AddChapters($chapter, $api->images($post->title, $i)));
                    }
                }

                if(isset($postDetail["status"])){
                    $post->status = Str::slug($postDetail["status"]);
                    $post->save();
                }
            }

        }

        $this->info("Chapters updated sucessfully");
    }
}
