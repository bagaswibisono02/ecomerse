<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Chat extends Component
{

    public $title = 'Chat with Us';

    // Gunakan mount() untuk mengirimkan emit
    public function mount()
    {
        // Emit event dengan data title
        $this->dispatch(['title', $this->title]);
    }


    public function render()
    {
        return view('livewire.chat',[
            'title' => "hahaha"
        ]);
    }
}
