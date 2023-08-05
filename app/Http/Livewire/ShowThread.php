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

    public function render()
    {   
        return view('livewire.show-thread');
    }
}
