<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Thread;
use Livewire\Component;

class ShowThreads extends Component
{   
    public $search = "";

    public function render()
    {   
        $categories = Category::all();

        /* Mi método */
        // $threads = Thread::where('title', 'LIKE', "%{$this->search}%")->latest()->withCount('replies')->get();

        /* Método del profesor (no se puede enviar con compact sino como propiedad) */
        $threads = Thread::query();
        $threads->where('title', 'LIKE', "%{$this->search}%");
        $threads->withCount('replies');
        $threads->latest();

        return view('livewire.show-threads', compact('categories'), [
            'threads' => $threads->get() // se envía como propiedad
        ]);
    }
}
