<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use Livewire\Component;

class ShowReply extends Component
{
    public Reply $reply; // inyección de dependencia

    public function render()
    {
        return view('livewire.show-reply');
    }
}
