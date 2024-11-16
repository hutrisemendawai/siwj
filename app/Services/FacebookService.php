<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FacebookService
{
    protected $accessToken;
    protected $pageId;

    public function __construct()
    {
        $this->accessToken = env('FACEBOOK_PAGE_ACCESS_TOKEN');
        $this->pageId = env('FACEBOOK_PAGE_ID');
    }

    public function postToFacebook($message, $imagePath = null)
    {
        if ($imagePath) {
            // Use the photos endpoint for images
            $url = "https://graph.facebook.com/{$this->pageId}/photos";
    
            // Prepare the data
            $data = [
                'caption' => $message,
                'access_token' => $this->accessToken,
            ];
    
            // Strip URL if it's included, leaving only the relative path
            $relativePath = str_replace(asset('storage/'), '', $imagePath);
            $localImagePath = storage_path('app/public/' . $relativePath);
    
            // Check if the file exists
            if (!file_exists($localImagePath)) {
                \Log::error('Image file not found: ' . $localImagePath);
                return false;
            }
    
            // Attach the image file
            $response = Http::attach(
                'source', file_get_contents($localImagePath), basename($localImagePath)
            )->post($url, $data);
        } else {
            // Use the feed endpoint for text-only posts
            $url = "https://graph.facebook.com/{$this->pageId}/feed";
            $data = [
                'message' => $message,
                'access_token' => $this->accessToken,
            ];
    
            $response = Http::post($url, $data);
        }
    
        // Log the response for debugging
        \Log::info('Facebook Post Response: ' . $response->body());
    
        return $response->successful();
    }
    
    
    


    // Method to retrieve posts from Facebook
    public function fetchFacebookPosts()
    {
        $url = "https://graph.facebook.com/{$this->pageId}/posts";
        return Http::get($url, ['access_token' => $this->accessToken])->json();
    }
}
