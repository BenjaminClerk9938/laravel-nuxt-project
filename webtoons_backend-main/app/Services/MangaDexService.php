<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class MangaDexService
{

    protected string $authUrl;
    protected string $base_url;
    protected string $clientId;
    protected string $clientSecret;
    protected string $userName;
    protected string $userPassword;
    protected string $grantType;
    protected string|null $accessToken;
    protected string|null $refreshToken;

    public function __construct()
    {
        $this->clientId = config('services.mangadex.client_id');
        $this->clientSecret = config('services.mangadex.client_secret');
        $this->userName = config('services.mangadex.username');
        $this->userPassword = config('services.mangadex.password');
        $this->grantType = config('services.mangadex.grant_type');
        $this->authUrl = config('services.mangadex.auth_url');
        $this->base_url = config('services.mangadex.base_url');

        $this->accessToken = Cache::get("access_token");

        if(!$this->accessToken) $this->getAccessToken();
    }

    /**
     * Get access token
     * @return array
     * @throws ConnectionException
     */
    public function getAccessToken()
    {
        $response = Http::asForm()->post($this->authUrl, [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => $this->grantType,
            'username' => $this->userName,
            'password' => $this->userPassword,
        ]);

        $data = $response->json();

        $this->accessToken = $data['access_token'] ?? null;
        $expiresIn = $data['expires_in'] ?? null;
        $refreshExpiresIn = $data['refresh_expires_in'] ?? null;
        $this->refreshToken = $data['refresh_token'] ?? null;

        Cache::put('access_token', $this->accessToken, $expiresIn);
        Cache::put('refresh_token', $this->refreshToken, $refreshExpiresIn);

        return [
            'access_token' => $this->accessToken,
            'expires_in' => $expiresIn,
            'refresh_expires_in' => $refreshExpiresIn,
            'refresh_token' => $this->refreshToken,
        ];
    }

    public function search(string $searchTerm, int $offset = 0){

        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Bearer $this->accessToken"
            ])
            ->get("$this->base_url/manga", [
                "offset" => $offset,
                "title" => $searchTerm,
                "limit" => 10,
                "includedTagsMode" => "AND",
                "excludedTagsMode" => "OR",
                "availableTranslatedLanguage" => [
                    "en"
                ],
                "contentRating" => [
                    "safe",
                    "suggestive",
                    "erotica",
                    "pornographic"
                ],
                "order" => [
                    "latestUploadedChapter" => "desc"
                ],
                "includes" => [
                    "cover_art",
                    "author",
                    "creator",
                    "chapter"
                ]
            ]);


        return $response->json();
    }


    public function find(string $id){
        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Bearer $this->accessToken"
            ])
            ->get("$this->base_url/manga/$id");

        return $response->json();
    }

    public function feed(string $id, $offset = 0, bool $includeFutureChapters = false, bool $includeExternalUrl = false)
    {
        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Bearer $this->accessToken"
            ])
            ->get("$this->base_url/manga/$id/feed", [
                "translatedLanguage" => ["en"],
                "offset" => $offset
            ]);

        return $response->json();
    }

    public function statistics(string $id)
    {
        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Bearer $this->accessToken"
            ])
            ->get("$this->base_url/statistics/manga/$id");

        return $response->json();
    }

    public function download(string $chapterId)
    {
        $response = Http::asForm()
            ->withHeaders([
                "Authorization" => "Bearer $this->accessToken"
            ])
            ->get("$this->base_url/at-home/server/$chapterId");

        return $response->json();
    }
}
