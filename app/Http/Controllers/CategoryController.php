<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('songs')->get();

        return view('categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $songs = $category->songs()
            ->with('artist', 'album')
            ->latest()
            ->paginate(20);

        return view('categories.show', compact('category', 'songs'));
    }
}
