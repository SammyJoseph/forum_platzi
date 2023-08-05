<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use App\Models\Thread;
use Livewire\Component;

class ShowReply extends Component
{
    public Reply $reply; // inyección de dependencia
    public $body = "";
    public $is_creating = false;

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
}
