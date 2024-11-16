<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Services\FacebookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    protected $facebookService;

    public function __construct(FacebookService $facebookService)
    {
        $this->facebookService = $facebookService;
    }

    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('blogs.index', compact('blogs'));
    }
    
    public function create()
    {
        return view('blogs.create'); // No $blogs variable needed here
    }
    
    


        public function store(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'nullable|image|max:2048',
            ]);
        
            // Save Blog post
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->content = $request->content;
        
            // Handle Image
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $blog->image = $path;
            }
        
            $blog->save();
        
            // Sync with Facebook
            try {
                $imagePath = $blog->image ? asset('storage/' . $blog->image) : null;
                $success = $this->facebookService->postToFacebook($blog->title . "\n\n" . $blog->content, $imagePath);
        
                if (!$success) {
                    return redirect()->route('blog.index')->with('error', 'Blog posted but failed to sync with Facebook.');
                }
            } catch (\Exception $e) {
                \Log::error('Facebook API Error: ' . $e->getMessage());
                return redirect()->route('blog.index')->with('error', 'Blog posted but failed to sync with Facebook.');
            }
        
            return redirect()->route('blog.index')->with('success', 'Blog posted and synced with Facebook!');
        }
        
    

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function fetchFacebookPosts()
{
    $posts = $this->facebookService->fetchFacebookPosts();
    return view('blogs.facebook_posts', compact('posts'));
}

public function verifyWebhook(Request $request)
{
    $verifyToken = env('FACEBOOK_WEBHOOK_VERIFY_TOKEN');

    \Log::info('Verify Token from Request: ' . $request->input('hub_verify_token'));
    \Log::info('Verify Token from Env: ' . $verifyToken);

    if ($request->input('hub_mode') === 'subscribe' && $request->input('hub_verify_token') === $verifyToken) {
        return response($request->input('hub_challenge'), 200);
    }
    return response('Forbidden', 403);
}





public function handleWebhook(Request $request)
{
    \Log::info('Received Facebook Webhook:', $request->all());

    $entries = $request->input('entry');

    if (!$entries) {
        \Log::warning('No entries found in webhook payload.');
        return response('Bad Request', 400);
    }

    foreach ($entries as $entry) {
        if (isset($entry['changes'])) {
            foreach ($entry['changes'] as $change) {
                \Log::info('Processing change:', $change);

                if ($change['field'] === 'feed') {
                    $postData = $change['value'];
                    
                    // Only process if it's a new status update from the page
                    if ($postData['item'] === 'status' && $postData['verb'] === 'add') {
                        $existingPost = Blog::where('facebook_post_id', $postData['post_id'])->first();
                        if (!$existingPost) {
                            Blog::create([
                                'title' => 'Facebook Post',
                                'content' => $postData['message'] ?? '',
                                'facebook_post_id' => $postData['post_id'],
                            ]);
                            \Log::info('Created new blog post from Facebook post ID: ' . $postData['post_id']);
                        } else {
                            \Log::info('Post already exists with Facebook post ID: ' . $postData['post_id']);
                        }
                    } else {
                        \Log::info('Ignoring post with item: ' . $postData['item'] . ' and verb: ' . $postData['verb']);
                    }
                } else {
                    \Log::info('Ignoring change with field: ' . $change['field']);
                }
            }
        } else {
            \Log::warning('No changes found in entry.');
        }
    }

    return response('EVENT_RECEIVED', 200);
}




}
