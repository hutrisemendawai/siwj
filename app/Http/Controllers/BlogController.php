<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Services\FacebookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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

    // Log semua parameter yang diterima
    Log::info('Webhook Request Parameters:', $request->all());

    // Log token dari env
    Log::info('Verify Token dari Env: ' . $verifyToken);

    // Ambil parameter dari query string menggunakan query()
    $mode = $request->query('hub_mode');
    $token = $request->query('hub_verify_token');
    $challenge = $request->query('hub_challenge');

    // Log masing-masing parameter
    Log::info("hub_mode: {$mode}");
    Log::info("hub_verify_token: {$token}");
    Log::info("hub_challenge: {$challenge}");

    if ($mode === 'subscribe' && $token === $verifyToken) {
        Log::info('Webhook berhasil diverifikasi.');
        return response($challenge, 200);
    }

    Log::warning('Verifikasi Webhook gagal.');
    return response('Forbidden', 403);
}

/**
 * Tangani Webhook dari Facebook
 */
public function handleWebhook(Request $request)
{
    Log::info('Received Facebook Webhook:', $request->all());

    $entries = $request->input('entry');

    if (!$entries) {
        Log::warning('No entries found in webhook payload.');
        // Mengembalikan 200 OK untuk mencegah Facebook mencoba ulang webhook
        return response('OK', 200);
    }

    foreach ($entries as $entry) {
        if (isset($entry['changes'])) {
            foreach ($entry['changes'] as $change) {
                Log::info('Processing change:', $change);

                if ($change['field'] === 'feed') {
                    $postData = $change['value'];

                    // Hanya proses jika ini adalah pembaruan status baru dari halaman
                    if (isset($postData['item']) && $postData['item'] === 'status' && isset($postData['verb']) && $postData['verb'] === 'add') {
                        if (isset($postData['post_id'])) {
                            $existingPost = Blog::where('facebook_post_id', $postData['post_id'])->first();
                            if (!$existingPost) {
                                Blog::create([
                                    'title' => 'Facebook Post',
                                    'content' => $postData['message'] ?? '',
                                    'facebook_post_id' => $postData['post_id'],
                                ]);
                                Log::info('Created new blog post from Facebook post ID: ' . $postData['post_id']);
                            } else {
                                Log::info('Post already exists with Facebook post ID: ' . $postData['post_id']);
                            }
                        } else {
                            Log::warning('post_id tidak ditemukan dalam postData.');
                        }
                    } else {
                        Log::info('Ignoring post with item: ' . ($postData['item'] ?? 'N/A') . ' and verb: ' . ($postData['verb'] ?? 'N/A'));
                    }
                } else {
                    Log::info('Ignoring change with field: ' . $change['field']);
                }
            }
        } else {
            Log::warning('No changes found in entry.');
        }
    }

    // Selalu mengembalikan 200 OK untuk mengakui penerimaan webhook
    return response('EVENT_RECEIVED', 200);
}



}
