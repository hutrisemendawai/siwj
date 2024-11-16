<?php

namespace App\Http\Controllers;

use App\Models\Gapost;
use Illuminate\Http\Request;

class GapostController extends Controller
{
    public function index()
    {
        $gaposts = Gapost::latest()->get();
        return view('galeri-akademik.index', compact('gaposts'));
    }

    public function create()
    {
        return view('galeri-akademik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        Gapost::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('galeri-akademik')->with('success', 'Post created successfully.');
    }

    public function show(Gapost $gapost)
    {
        return view('galeri-akademik.show', compact('gapost'));
    }

    public function edit(Gapost $gapost)
    {
        return view('galeri-akademik.edit', compact('gapost'));
    }

    public function update(Request $request, Gapost $gapost)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('image') ? $request->file('image')->store('images', 'public') : $gapost->image;

        $gapost->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
        ]);

        return redirect()->route('galeri-akademik')->with('success', 'Post updated successfully.');
    }

    public function destroy(Gapost $gapost)
    {
        // Delete the image file if it exists
        if ($gapost->image) {
            \Storage::disk('public')->delete($gapost->image);
        }

        // Delete the post
        $gapost->delete();

        return redirect()->route('galeri-akademik')->with('success', 'Post deleted successfully.');
    }
}
