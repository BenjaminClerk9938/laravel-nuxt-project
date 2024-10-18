<?php

namespace App\Jobs;

use App\Models\PostChapter;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AddChapters implements ShouldQueue
{
    use Queueable;

    private PostChapter $postChapter;
    private array $files;

    /**
     * Create a new job instance.
     */
    public function __construct(PostChapter $postChapter, array $files)
    {
        $this->postChapter = $postChapter;
        $this->files = $files;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $downloadedCount = 0;

        foreach ($this->files as $file) {
            try {
                $this->postChapter->addMediaFromUrl($file)->toMediaCollection('chapter');
                $downloadedCount++;
            } catch (Exception $e) {
            }
        }

        if ($downloadedCount === count($this->files)) {
            $this->postChapter->downloaded = 1;
            $this->postChapter->save();
        }
    }
}
