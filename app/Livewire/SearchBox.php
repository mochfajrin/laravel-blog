<?php

namespace App\Livewire;

use Livewire\Component;

use function Laravel\Prompts\search;

class SearchBox extends Component
{
    public $search = "";

    public function searchTitle()
    {
        $this->dispatch("search", search: $this->search);
    }

    public function render()
    {
        return view('livewire.search-box');
    }
}
