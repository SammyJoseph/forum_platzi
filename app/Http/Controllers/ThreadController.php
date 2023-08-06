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

    public function update(Request $request, Thread $thread)
    {
        $request->validate([
            'title' => 'required|min:5',
            'body' => 'required|min:5',
            'category_id' => 'required|exists:categories,id'
        ]);

        $thread->update($request->all());

        return redirect()->route('thread', $thread); // redirecciona a la ruta thread (show de livewire) con la pregunta actualizada
    }
}
