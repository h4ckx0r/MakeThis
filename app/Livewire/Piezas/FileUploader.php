<?php

namespace App\Livewire\Piezas;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploader extends Component
{
    use WithFileUploads;

    public $file;
    public $tipo; // '3d' o 'imagen'
    public $acceptedFormats;
    public $placeholder;

    public function mount($tipo = '3d')
    {
        $this->tipo = $tipo;

        if ($tipo === '3d') {
            $this->acceptedFormats = '.obj,.stl,.3mf';
            $this->placeholder = 'Arrastre aquí el modelo 3d de su pieza (OBJ, STL, 3MF)';
        } else {
            $this->acceptedFormats = 'image/*';
            $this->placeholder = 'Suba todas las imágenes posibles';
        }
    }

    public function render()
    {
        return view('livewire.piezas.file-uploader');
    }
}
