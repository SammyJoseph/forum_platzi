<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Thread;

class ThreadController extends Controller
{   
    public function create(Thread $thread)
    {
        $categories = Category::all();

        return view('thread.create', compact('categories', 'thread'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:5',
            'body' => 'required|min:5',
            'category_id' => 'required|exists:categories,id'
        ]);

        /* threads() es una relacion de user con thread */
        $thread = auth()->user()->threads()->create($request->all()); // crea la pregunta con el usuario autenticado

        // return redirect()->route('thread', $thread); // redirecciona a la ruta thread (show de livewire) con la pregunta creada
        return redirect()->route('dashboard');
    }

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
