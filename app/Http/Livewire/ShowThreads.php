<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Thread;
use Livewire\Component;
use Livewire\WithPagination;

class ShowThreads extends Component
{   
    use WithPagination;
    
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

        /* Sin el eager loading ($threads->with('user', 'category')), la consulta original solo recuperaría los hilos principales sin cargar las relaciones "user" y "category". 
        Luego, cuando iteras a través de los hilos en la vista para mostrar la información del usuario y la categoría asociados a cada hilo,
        Eloquent realizaría una consulta adicional por cada hilo para recuperar los datos de usuario y categoría,
        lo que resultaría en muchas más consultas a la base de datos (una por hilo). */
        $threads->with('user', 'category'); // eager loading (optimización de consultas)

        $threads->withCount('replies'); // agregamos el conteo de respuestas (replies_count en la vista)
        $threads->latest(); // ordenamos por fecha de creación
        $threads = $threads->paginate(4); // obtenemos los resultados para enviarlo con compact

        return view('livewire.show-threads', compact('categories', 'threads', 'threadsCount'));
    }

    public function filterByCategory($category)
    {   
        $this->updatingSearch();
        $this->category = $category;
    }

    public function updatingSearch() // se ejecuta automáticamente cuando se modifica el valor de $search
    {
        $this->resetPage(); // resetea la paginación
    }
}
