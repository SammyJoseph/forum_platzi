<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Thread;

class ThreadController extends Controller
{
    public function edit(Thread $thread) // recibe el modelo Thread y lo busca por id
    {
        $categories = Category::all();

        return view('thread.edit', compact('thread', 'categories'));
    }
}
