<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::with('user', 'comments.user')->latest()->get();
        return view('discussions.index', compact('discussions'));
    }

    public function create()
    {
        return view('discussions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);
    
        auth()->user()->discussions()->create($request->all());
    
        return redirect()->route('discussions.index');
    }
    

    public function show(Discussion $discussion)
    {
        $discussion->load('comments.user'); // Load comments with user relationship
        return view('discussions.show', compact('discussion'));
    }
    

    public function edit(Discussion $discussion)
    {
        $this->authorize('update', $discussion);
        return view('discussions.edit', compact('discussion'));
    }

    public function update(Request $request, Discussion $discussion)
    {
        $this->authorize('update', $discussion);

        $request->validate(['content' => 'required']);

        $discussion->update($request->only('content'));

        return redirect()->route('discussions.index');
    }

    public function destroy(Discussion $discussion)
    {
        $this->authorize('delete', $discussion);
        $discussion->delete();

        return redirect()->route('discussions.index');
    }
}
