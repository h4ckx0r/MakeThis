<?php

namespace App\Livewire\Admin;

use App\Models\Tag;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TagsManager extends Component
{
    public string $newName = '';

    public ?string $editingId   = null;
    public string  $editingName = '';

    public ?string $confirmingDeleteId = null;
    public ?string $errorMessage       = null;

    // ── Add ──────────────────────────────────────────────────────────────────

    public function addTag(): void
    {
        $this->validate([
            'newName' => 'required|string|max:64|unique:tags,nombre',
        ]);

        Tag::create(['nombre' => trim($this->newName)]);

        $this->newName      = '';
        $this->errorMessage = null;
        $this->resetValidation('newName');
    }

    // ── Edit ─────────────────────────────────────────────────────────────────

    public function startEdit(string $id): void
    {
        $tag = Tag::find($id);
        if (! $tag) {
            return;
        }

        $this->editingId          = $id;
        $this->editingName        = $tag->nombre;
        $this->confirmingDeleteId = null;
        $this->errorMessage       = null;
        $this->resetValidation('editingName');
    }

    public function saveEdit(): void
    {
        $this->validate([
            'editingName' => [
                'required',
                'string',
                'max:64',
                Rule::unique('tags', 'nombre')->ignore($this->editingId),
            ],
        ]);

        $tag = Tag::findOrFail($this->editingId);
        $tag->update(['nombre' => trim($this->editingName)]);

        $this->editingId = null;
    }

    public function cancelEdit(): void
    {
        $this->editingId = null;
        $this->resetValidation('editingName');
    }

    // ── Delete ────────────────────────────────────────────────────────────────

    public function confirmDelete(string $id): void
    {
        $this->confirmingDeleteId = $id;
        $this->editingId          = null;
        $this->errorMessage       = null;
    }

    public function cancelDelete(): void
    {
        $this->confirmingDeleteId = null;
    }

    public function deleteTag(): void
    {
        $tag = Tag::withCount('piezaCatalogos')->findOrFail($this->confirmingDeleteId);

        if ($tag->pieza_catalogos_count > 0) {
            $this->errorMessage       = "No se puede eliminar \"{$tag->nombre}\": tiene {$tag->pieza_catalogos_count} pieza(s) asociada(s).";
            $this->confirmingDeleteId = null;
            return;
        }

        $tag->delete();
        $this->confirmingDeleteId = null;
        $this->errorMessage       = null;
    }

    // ── Render ────────────────────────────────────────────────────────────────

    public function render()
    {
        $tags = Tag::withCount('piezaCatalogos')->orderBy('nombre')->get();

        return view('livewire.admin.tags-manager', compact('tags'));
    }
}
