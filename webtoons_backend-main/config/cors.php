<?php

return [

/*
|--------------------------------------------------------------------------
| Laravel CORS Configuration
|--------------------------------------------------------------------------
|
| Here you may configure your settings for cross-origin resource sharing
| or "CORS". This determines what cross-origin operations may execute
| in web browsers. You are free to adjust these settings as needed.
|
| To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
|
*/

'paths' => ['api/*'],  // Define the paths you want CORS to be applied to. 'api/*' applies it to all API routes.

'allowed_methods' => ['*'],  // Specify allowed HTTP methods. '*' means all methods are allowed.

'allowed_origins' => ['*'],  // '*' allows all origins, but it's safer to specify exact domains in production.

'allowed_origins_patterns' => [],  // Alternative to 'allowed_origins' with regular expression patterns for more flexibility.

'allowed_headers' => ['*'],  // '*' means any headers are allowed. You can specify exact headers if needed.

'exposed_headers' => [],  // Headers you want to expose to the browser (leave empty if you don't need to expose any).

'max_age' => 0,  // Specifies how long the results of a preflight request can be cached.

'supports_credentials' => false,  // Set this to true if you need cookies or authentication credentials in cross-origin requests.
];
