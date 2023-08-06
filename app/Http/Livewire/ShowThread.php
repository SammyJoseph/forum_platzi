<?php

namespace App\Http\Livewire;

use App\Models\Thread;
use Livewire\Component;

class ShowThread extends Component
{   
    /* Al utilizar Thread $thread, se está permitiendo que Livewire inyecte automáticamente una instancia del modelo Thread en el controlador,
    lo que permite trabajar con el modelo directamente sin tener que crearlo manualmente. 
    Esto facilita el acceso a los datos y métodos del modelo en el controlador y vista de Livewire. */
    /* La ruta /thread espera un parámetro /thread/{thread} */
    public Thread $thread; // inyección de dependencia

    public $body = "";

    public function render()
    {   
        /* whereNull() es para obtener solo las respuestas que son padres ya que el campo reply_id en la bd solo tiene información cuando es una respuesta hija */
        $replies = $this->thread->replies()->whereNull('reply_id')->latest()->get(); // se obtienen las respuestas de la pregunta

        $replies_count = $this->thread->replies()->count(); // conteo de respuestas de la pregunta
        
        return view('livewire.show-thread', compact('replies', 'replies_count'));
    }

    public function postReply(){
        // validar
        $this->validate([
            'body' => 'required|min:5'
        ]);

        // crear
        auth()->user()->replies()->create([ // replies() es la relación en el modelo User
            'thread_id' => $this->thread->id, // se obtiene el id del modelo inyectado
            'body' => $this->body
        ]);

        // refrescar
        $this->body = "";
    }
}
