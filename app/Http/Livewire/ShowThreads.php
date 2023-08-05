<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Thread;
use Livewire\Component;

class ShowThreads extends Component
{   
    public $search = "";
    public $category = "";

    public function render()
    {   
        $categories = Category::all();

        /* Mi método */
        // $threads = Thread::where('title', 'LIKE', "%{$this->search}%")->latest()->withCount('replies')->get();

        /* Método del profesor */
        $threads = Thread::query(); // iniciamos la consulta así para poder usar condicionales
        $threads->where('title', 'LIKE', "%{$this->search}%"); // filtramos por título

        /* Al inicio este bloque de código se ignora porque $this->category es null */
        if ($this->category) { // si hay una categoría seleccionada
            $threads->where('category_id', $this->category); // filtramos por categoría
        }

        $threadsCount = $threads->count(); // conteo de preguntas (threads_count en la vista)

        $threads->withCount('replies'); // agregamos el conteo de respuestas (replies_count en la vista)
        $threads->latest(); // ordenamos por fecha de creación
        $threads = $threads->get(); // obtenemos los resultados para enviarlo con compact

        return view('livewire.show-threads', compact('categories', 'threads', 'threadsCount'));
    }

    public function filterByCategory($category)
    {
        $this->category = $category;
    }
}
