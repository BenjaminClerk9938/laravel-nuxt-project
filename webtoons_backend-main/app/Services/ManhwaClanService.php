<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ManhwaClanService {

    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config("services.manhwa_clan.base_url");
    }

    public function search(string $searchTerm)
    {
        $response = Http::get($this->baseUrl . "/search/$searchTerm");

        return $response->json()["results"] ?? [];
    }


    public function details($apiUrlDetails)
    {
        $response = Http::get($apiUrlDetails);

        return $response->json();
    }

    public function images($mangaTitle, $chapter)
    {
        $slugTitle = Str::slug($mangaTitle);
        $response = Http::get("$this->baseUrl/$slugTitle/$chapter/images");

        return $response->json()["images"] ?? [];
    }

}
