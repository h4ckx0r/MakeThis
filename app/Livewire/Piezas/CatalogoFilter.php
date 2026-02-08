<?php

namespace App\Livewire\Piezas;

use App\Models\Tag;
use Livewire\Component;

class CatalogoFilter extends Component
{
    #[\Livewire\Attributes\Reactive]
    public $search = '';

    #[\Livewire\Attributes\Reactive]
    public $selectedTags = [];

    public $availableTags;

    public function mount()
    {
        $this->availableTags = Tag::all();
    }

    public function toggleTag($tagId)
    {
        if (in_array($tagId, $this->selectedTags)) {
            $this->selectedTags = array_diff($this->selectedTags, [$tagId]);
        } else {
            $this->selectedTags[] = $tagId;
        }
    }

    public function render()
    {
        return view('livewire.piezas.catalogo-filter');
    }
}
