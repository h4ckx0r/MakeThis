<?php

namespace App\Livewire\Piezas;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploader extends Component
{
    use WithFileUploads;

    public $file;
    public string $tipo;
    public string $acceptedFormats;
    public string $placeholder;

    public function mount(string $tipo = '3d'): void
    {
        $this->tipo = $tipo;

        if ($tipo === '3d') {
            $this->acceptedFormats = '.obj,.stl,.3mf';
            $this->placeholder = 'Arrastre aquí el modelo 3D de su pieza (OBJ, STL, 3MF)';
        } else {
            $this->acceptedFormats = 'image/*';
            $this->placeholder = 'Suba imágenes de referencia de su pieza';
        }
    }

    public function updatedFile(): void
    {
        if (!$this->file) {
            return;
        }

        $this->validate([
            'file' => $this->tipo === '3d'
                ? 'required|file|max:51200|mimes:obj,stl,3mf'
                : 'required|file|max:10240|mimes:jpg,jpeg,png,webp',
        ]);

        $extension = $this->file->getClientOriginalExtension();
        $uuid = (string) Str::uuid();
        $filename = "{$uuid}.{$extension}";
        $this->file->storeAs('temp', $filename, 'public');

        $path = "temp/{$filename}";
        $name = $this->file->getClientOriginalName();
        $tipo = $this->tipo;

        $this->js("window.dispatchEvent(new CustomEvent('file-uploaded', {
            detail: { path: " . json_encode($path) . ", name: " . json_encode($name) . ", tipo: " . json_encode($tipo) . " }
        }))");
    }

    public function render()
    {
        return view('livewire.piezas.file-uploader');
    }
}
