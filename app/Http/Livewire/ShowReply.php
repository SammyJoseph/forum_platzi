<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use Livewire\Component;

class ShowReply extends Component
{
    public Reply $reply; // inyección de dependencia
    public $body = "";
    public $is_creating = false;
    public $is_editing = false;

    protected $listeners = ['refresh' => '$refresh']; // para que se refresque el componente cuando se emita el evento

    public function render()
    {
        return view('livewire.show-reply');
    }

    public function postChild(){
        // si la respuesta ya tiene una respuesta, no permitir que se cree otra
        if ( ! is_null($this->reply->reply_id)) return;

        // validar
        $this->validate([
            'body' => 'required|min:5'
        ]);

        // crear
        auth()->user()->replies()->create([ // se crea con el id del usuario autenticado
            'reply_id' => $this->reply->id, // esta respuesta se va a crear con el id de la respuesta padre
            'thread_id' => $this->reply->thread->id, // a qué pregunta principal pertenece
            'body' => $this->body // cuerpo de la respuesta
        ]);

        // refrescar
        $this->is_creating = false;
        $this->body = "";
        $this->emitSelf('refresh'); // se emite el evento para que se refresque el componente
    }

    public function updateReply(){
        // validar
        $this->validate([
            'body' => 'required|min:5'
        ]);

        // actualizar
        $this->reply->update([
            'body' => $this->body
        ]);

        // refrescar
        $this->is_editing = false;
    }

    public function updatedIsEditing(){ // se ejecuta cuando se hace click en el botón de editar
        $this->is_creating = false;
        $this->body = $this->reply->body;
    }

    public function updatedIsCreating(){ // se ejecuta cuando se hace click en el botón de responder
        $this->is_editing = false;
        $this->body = "";
    }
}
