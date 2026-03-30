<?php

// Parse CLOUDINARY_URL manually to extract cloud name, key, and secret
$url = env('CLOUDINARY_URL');

$cloud_name = null;
$api_key = null;
$api_secret = null;

if ($url) {
    // cloudinary://API_KEY:API_SECRET@CLOUD_NAME
    $parts = parse_url($url);

    if ($parts) {
        $cloud_name = $parts['host'] ?? null;
        $api_key = $parts['user'] ?? null;
        $api_secret = $parts['pass'] ?? null;
    }
}

return [
    'cloud_name' => $cloud_name,
    'api_key' => $api_key,
    'api_secret' => $api_secret,
    'url' => [
        'secure' => true,
    ],
];