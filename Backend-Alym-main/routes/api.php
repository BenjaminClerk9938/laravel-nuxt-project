<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix("post")->controller(PostController::class)->group(function (){
    Route::get("/", "index");
    Route::get("/tags", "tags");
    Route::post("search", "search");
    Route::get("/{slug}", "post");
    Route::get("/{slug}/{number}", "chapter");
});
