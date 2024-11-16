<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Discussion;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Discussion $discussion)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
    
        $comment = $discussion->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
    
        return response()->json([
            'success' => true,
            'user_name' => auth()->user()->name,
            'user_photo' => auth()->user()->profile_photo ? asset('storage/profile_photos/' . auth()->user()->profile_photo) : asset('storage/profile_photos/default.jpg'),
            'content' => $comment->content,
        ]);
    }
    

    public function destroy(Discussion $discussion, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return redirect()->route('discussions.show', $discussion->id);
    }
}
